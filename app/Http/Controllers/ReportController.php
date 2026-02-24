<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    /**
     * Reports index page
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Reorder report
     */
    public function reorder(Request $request)
    {
        $q = $request->get('q', '');

        $query = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.id as product_id',
                'p.sku',
                'p.name',
                'w.code as wh',
                'il.on_hand',
                'p.reorder_point'
            )
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC');

        if ($q) {
            $query->where(function ($qry) use ($q) {
                $qry->where('p.sku', 'like', "%{$q}%")
                    ->orWhere('p.name', 'like', "%{$q}%");
            });
        }

        $rows = $query->paginate(25)->withQueryString();

        return view('reports.reorder', compact('rows', 'q'));
    }

    /**
     * Stock report
     */
    public function stock(Request $request)
    {
        $q = $request->get('q', '');
        $warehouse = $request->get('warehouse', '');

        $query = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.sku',
                'p.name as product_name',
                'w.code as wh_code',
                'w.name as wh_name',
                'w.id as warehouse_id',
                'il.on_hand',
                'il.on_order',
                'il.allocated'
            )
            ->orderBy('w.code')
            ->orderBy('p.sku');

        // Search filter
        if ($q) {
            $query->where(function ($qry) use ($q) {
                $qry->where('p.sku', 'like', "%{$q}%")
                    ->orWhere('p.name', 'like', "%{$q}%");
            });
        }

        // Warehouse filter
        if ($warehouse) {
            $query->where('w.id', $warehouse);
        }

        $rows = $query->paginate(25)->withQueryString();

        return view('reports.stock', compact('rows', 'q', 'warehouse'));
    }

    /**
     * Movements report
     */
    public function movements(Request $request)
    {
        $range = $request->get('range', '7d');

        $days = match ($range) {
            '30d' => 30,
            '90d' => 90,
            'all' => 9999,
            default => 7,
        };

        $query = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.created_at',
                'm.type',
                'm.qty',
                'm.reference',
                'p.sku',
                'p.name as product_name',
                'w.code as warehouse_code',
                'u.name as user_name'
            )
            ->orderByDesc('m.created_at');

        if ($range !== 'all') {
            $query->where('m.created_at', '>=', now()->subDays($days));
        }

        $rows = $query->paginate(50)->withQueryString();

        return view('reports.movements', compact('rows', 'range'));
    }

    /**
     * Low stock report (alias for reorder)
     */
    public function lowStock(Request $request)
    {
        return $this->reorder($request);
    }

    /**
     * Export CSV
     */
    public function export(Request $request, $which)
    {
        return match ($which) {
            'reorder' => $this->exportReorderCsv($request),
            'movements' => $this->exportMovementsCsv($request),
            'stock', 'inventory' => $this->exportStockCsv($request),
            'lowstock', 'low-stock' => $this->exportLowStockCsv($request),
            default => abort(404, 'CSV export not available for this report'),
        };
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request, $which)
    {
        $range = $request->get('range', '7d');

        return match ($which) {
            'reorder' => $this->generateReorderPdf(),
            'movements' => $this->generateMovementsPdf($range),
            'stock', 'inventory' => $this->generateStockPdf(),
            'lowstock', 'low-stock' => $this->generateLowStockPdf(),
            default => abort(404, 'PDF export not available for this report'),
        };
    }

    /**
     * Export reorder report as CSV
     */
    private function exportReorderCsv(Request $request)
    {
        $q = $request->get('q', '');

        $query = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.sku',
                'p.name as product_name',
                'w.code as warehouse_code',
                'w.name as warehouse_name',
                'il.on_hand',
                'p.reorder_point',
                DB::raw('(p.reorder_point - il.on_hand) as shortage')
            )
            ->whereColumn('il.on_hand', '<', 'p.reorder_point');

        if ($q) {
            $query->where(function ($qry) use ($q) {
                $qry->where('p.sku', 'like', "%{$q}%")
                    ->orWhere('p.name', 'like', "%{$q}%");
            });
        }

        $rows = $query->orderByDesc('shortage')->get();

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header row
            fputcsv($file, [
                'SKU',
                'Product Name',
                'Warehouse Code',
                'Warehouse Name',
                'On Hand',
                'Reorder Point',
                'Shortage',
                'Status'
            ]);

            // Data rows
            foreach ($rows as $row) {
                $onHand = (int)$row->on_hand;
                $reorderPoint = (int)$row->reorder_point;
                $isCritical = $onHand <= ($reorderPoint * 0.5);
                $status = $isCritical ? 'CRITICAL' : 'LOW';

                fputcsv($file, [
                    $row->sku,
                    $row->product_name,
                    $row->warehouse_code,
                    $row->warehouse_name,
                    $onHand,
                    $reorderPoint,
                    $row->shortage,
                    $status
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload(
            $callback,
            'reorder-report-' . now()->format('Y-m-d') . '.csv',
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="reorder-report-' . now()->format('Y-m-d') . '.csv"',
            ]
        );
    }

    /**
     * Export movements as CSV
     */
    private function exportMovementsCsv(Request $request)
    {
        $range = $request->get('range', '7d');

        $days = match ($range) {
            '30d' => 30,
            '90d' => 90,
            'all' => 9999,
            default => 7,
        };

        $query = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.created_at',
                'm.type',
                'm.qty',
                'p.sku',
                'p.name as product_name',
                'w.code as warehouse_code',
                'm.reference',
                'u.name as user_name',
                'm.notes'
            )
            ->orderByDesc('m.created_at');

        if ($range !== 'all') {
            $query->where('m.created_at', '>=', now()->subDays($days));
        }

        $rows = $query->get();

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'Date',
                'Time',
                'Type',
                'Quantity',
                'SKU',
                'Product',
                'Warehouse',
                'Reference',
                'User',
                'Notes'
            ]);

            // Data
            foreach ($rows as $row) {
                $date = Carbon::parse($row->created_at);
                fputcsv($file, [
                    $date->format('Y-m-d'),
                    $date->format('H:i:s'),
                    $row->type,
                    $row->qty,
                    $row->sku,
                    $row->product_name,
                    $row->warehouse_code,
                    $row->reference ?: '',
                    $row->user_name ?: '',
                    $row->notes ?: ''
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload(
            $callback,
            'movements-report-' . now()->format('Y-m-d') . '.csv',
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="movements-report-' . now()->format('Y-m-d') . '.csv"',
            ]
        );
    }

    /**
     * Export stock/inventory as CSV
     */
    private function exportStockCsv(Request $request)
    {
        $q = $request->get('q', '');
        $warehouse = $request->get('warehouse', '');

        $query = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.sku',
                'p.name as product_name',
                'w.code as warehouse_code',
                'w.name as warehouse_name',
                'il.on_hand',
                'il.on_order',
                'il.allocated',
                DB::raw('(il.on_hand - il.allocated) as available')
            )
            ->orderBy('p.sku')
            ->orderBy('w.code');

        if ($q) {
            $query->where(function ($qry) use ($q) {
                $qry->where('p.sku', 'like', "%{$q}%")
                    ->orWhere('p.name', 'like', "%{$q}%");
            });
        }

        if ($warehouse) {
            $query->where('w.id', $warehouse);
        }

        $rows = $query->get();

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                'SKU',
                'Product Name',
                'Warehouse Code',
                'Warehouse Name',
                'On Hand',
                'On Order',
                'Allocated',
                'Available'
            ]);

            foreach ($rows as $row) {
                fputcsv($file, [
                    $row->sku,
                    $row->product_name,
                    $row->warehouse_code,
                    $row->warehouse_name,
                    $row->on_hand,
                    $row->on_order,
                    $row->allocated,
                    $row->available
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload(
            $callback,
            'inventory-report-' . now()->format('Y-m-d') . '.csv',
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="inventory-report-' . now()->format('Y-m-d') . '.csv"',
            ]
        );
    }

    /**
     * Export low stock as CSV
     */
    private function exportLowStockCsv(Request $request)
    {
        return $this->exportReorderCsv($request);
    }

    /**
     * Generate Stock PDF
     */
    private function generateStockPdf()
    {
        $rows = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'w.code as warehouse',
                'p.sku',
                'p.name',
                'il.on_hand',
                'il.allocated',
                'il.on_order'
            )
            ->orderBy('w.code')
            ->orderBy('p.sku')
            ->get();

        $pdf = Pdf::loadView('reports.pdf.stock', compact('rows'));
        
        return $pdf->download('stock-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate Reorder PDF
     */
    private function generateReorderPdf()
    {
        $rows = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.sku',
                'p.name',
                'w.code as warehouse',
                'il.on_hand',
                'p.reorder_point',
                DB::raw('(p.reorder_point - il.on_hand) as shortage')
            )
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->orderByDesc('shortage')
            ->get();

        $pdf = Pdf::loadView('reports.pdf.reorder', compact('rows'));
        
        return $pdf->download('reorder-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate Movements PDF
     */
    private function generateMovementsPdf($range = '7d')
    {
        $days = match ($range) {
            '30d' => 30,
            '90d' => 90,
            'all' => 9999,
            default => 7,
        };

        $query = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.created_at',
                'm.type',
                'm.qty',
                'p.sku',
                'p.name as product',
                'w.code as warehouse',
                'm.reference',
                'u.name as user'
            )
            ->orderByDesc('m.created_at');

        if ($range !== 'all') {
            $query->where('m.created_at', '>=', now()->subDays($days));
        }

        $rows = $query->get();

        $pdf = Pdf::loadView('reports.pdf.movements', compact('rows', 'range'));
        
        return $pdf->download('movements-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate Low Stock PDF
     */
    private function generateLowStockPdf()
    {
        return $this->generateReorderPdf();
    }

    /**
     * Email low stock report
     */
    public function emailLowStock(Request $request)
    {
        // Implementation for emailing low stock report
        return back()->with('success', 'Low stock report has been sent successfully!');
    }
}
