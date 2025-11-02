<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function reorder(Request $request)
    {
        $q = trim($request->get('q', ''));
        
        $rows = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.id as product_id',
                'p.sku',
                'p.name',
                'p.reorder_point',
                'il.on_hand',
                'w.code as wh_code',
                'w.name as wh_name'
            )
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->when($q, function ($query) use ($q) {
                $like = "%{$q}%";
                $query->where(function ($x) use ($like) {
                    $x->where('p.sku', 'like', $like)
                      ->orWhere('p.name', 'like', $like);
                });
            })
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC')
            ->paginate(20)
            ->withQueryString();

        $count = $rows->total();

        return view('reports.reorder', compact('rows', 'q', 'count'));
    }

    public function stock(Request $request)
    {
        $rows = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.sku',
                'p.name as product_name',
                'w.code as wh_code',
                'w.name as wh_name',
                'il.on_hand',
                'il.on_order',
                'il.allocated'
            )
            ->orderBy('p.sku')
            ->orderBy('w.code')
            ->paginate(50);

        return view('reports.stock', compact('rows'));
    }

    public function movements(Request $request)
    {
        $range = $request->get('range', '7d');
        
        $days = match($range) {
            '30d' => 30,
            '90d' => 90,
            default => 7,
        };

        $rows = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.id',
                'm.type',
                'm.qty',
                'm.reference',
                'm.notes',
                'm.created_at',
                'p.sku',
                'p.name as product_name',
                'w.code as wh_code',
                'u.name as user_name'
            )
            ->where('m.created_at', '>=', now()->subDays($days))
            ->orderByDesc('m.created_at')
            ->paginate(50)
            ->withQueryString();

        return view('reports.movements', compact('rows', 'range'));
    }

    /**
     * Export CSV
     */
    public function export(Request $request, $which)
    {
        if ($which === 'reorder') {
            return $this->exportReorderCsv();
        }
        
        if ($which === 'stock') {
            return $this->exportStockCsv();
        }
        
        if ($which === 'movements') {
            $range = $request->get('range', '7d');
            return $this->exportMovementsCsv($range);
        }

        abort(404, 'Unknown report type');
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request, $which)
    {
        if ($which === 'reorder') {
            return $this->exportReorderPdf();
        }
        
        abort(404, 'PDF export not available for this report');
    }

    /**
     * Send low stock email
     */
    public function emailLowStock()
    {
        $items = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->select('p.sku', 'p.name', 'il.on_hand', 'p.reorder_point')
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC')
            ->get();

        $to = config('mail.low_stock_to', env('LOW_STOCK_TO', 'admin@example.com'));

        try {
            Mail::send('emails.low_stock_summary', compact('items'), function ($message) use ($to) {
                $message->to($to)
                    ->subject('Low Stock Summary - ' . now()->format('Y-m-d'));
            });

            return back()->with('success', "Low stock email sent to {$to}");
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    // Private helper methods
    private function exportReorderCsv()
    {
        $rows = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select('p.sku', 'p.name', 'w.code as wh', 'il.on_hand', 'p.reorder_point')
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC')
            ->get();

        $filename = 'reorder-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['SKU', 'Name', 'Warehouse', 'On Hand', 'Reorder Point']);

            foreach ($rows as $r) {
                fputcsv($file, [
                    $r->sku,
                    $r->name,
                    $r->wh,
                    $r->on_hand,
                    $r->reorder_point,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportStockCsv()
    {
        $rows = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select(
                'p.sku',
                'p.name',
                'w.code as wh',
                'il.on_hand',
                'il.on_order',
                'il.allocated'
            )
            ->orderBy('p.sku')
            ->orderBy('w.code')
            ->get();

        $filename = 'stock-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['SKU', 'Product', 'Warehouse', 'On Hand', 'On Order', 'Allocated']);

            foreach ($rows as $r) {
                fputcsv($file, [
                    $r->sku,
                    $r->name,
                    $r->wh,
                    $r->on_hand,
                    $r->on_order,
                    $r->allocated,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportMovementsCsv($range)
    {
        $days = match($range) {
            '30d' => 30,
            '90d' => 90,
            default => 7,
        };

        $rows = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.created_at',
                'm.type',
                'm.qty',
                'm.reference',
                'p.sku',
                'p.name as product',
                'w.code as warehouse',
                'u.name as user'
            )
            ->where('m.created_at', '>=', now()->subDays($days))
            ->orderByDesc('m.created_at')
            ->get();

        $filename = "movements-{$range}-" . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Type', 'Qty', 'Reference', 'SKU', 'Product', 'Warehouse', 'User']);

            foreach ($rows as $r) {
                fputcsv($file, [
                    $r->created_at,
                    $r->type,
                    $r->qty,
                    $r->reference ?? '',
                    $r->sku,
                    $r->product,
                    $r->warehouse,
                    $r->user ?? '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportReorderPdf()
    {
        // Simple text-based PDF generation (you can use a library like DomPDF for better results)
        $rows = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select('p.sku', 'p.name', 'w.code as wh', 'il.on_hand', 'p.reorder_point')
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC')
            ->get();

        return view('reports.pdf.reorder', compact('rows'));
    }
}
