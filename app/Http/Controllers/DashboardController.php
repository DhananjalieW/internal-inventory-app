<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $u = auth()->user();

        if ($u->role === 'Admin') {
            $data = $this->getAdminData();
            return view('dash.admin', $data);
        }

        if ($u->role === 'Inventory Manager') {
            $data = $this->getManagerData();
            return view('dash.manager', $data);
        }

        if ($u->role === 'Clerk') {
            $data = $this->getClerkData();
            return view('dash.clerk', $data);
        }

        $data = $this->getViewerData();
        return view('dash.viewer', $data);
    }

    private function getAdminData()
    {
        // KPI counts
        $usersCount = DB::table('users')->count();
        $productsCount = DB::table('products')->count();
        $warehousesCount = DB::table('warehouses')->count();
        
        $openPoCount = 0;
        $openPoDueSoon = 0;
        if (DB::getSchemaBuilder()->hasTable('purchase_orders')) {
            $openPoCount = DB::table('purchase_orders')
                ->whereIn('status', ['DRAFT', 'SENT'])
                ->count();
                
            $openPoDueSoon = DB::table('purchase_orders')
                ->whereIn('status', ['DRAFT', 'SENT'])
                ->whereDate('expected_date', '<=', now()->addDays(7))
                ->count();
        }

        // Movement summary (7d)
        $mvSummary = DB::table('stock_movements')
            ->selectRaw("type, COUNT(*) as cnt")
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('type')
            ->pluck('cnt', 'type')
            ->toArray();

        // Low stock count
        $lowStockCount = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->count();

        // Low stock items (top 10)
        $lowStock = DB::table('inventory_levels as il')
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
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC')
            ->limit(10)
            ->get();

        // Pending approvals
        $pendingApprovals = 0;
        if (DB::getSchemaBuilder()->hasTable('approval_requests')) {
            $pendingApprovals = DB::table('approval_requests')
                ->where('status', 'pending')
                ->count();
        }

        // Stock by warehouse
        $stockByWh = DB::table('inventory_levels as il')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select('w.code', DB::raw('SUM(il.on_hand) as qty'))
            ->groupBy('w.id', 'w.code')
            ->orderBy('w.code')
            ->get();

        // Recent activity
        $recent = collect([]);
        if (DB::getSchemaBuilder()->hasTable('activity_log')) {
            $recent = DB::table('activity_log')
                ->orderByDesc('id')
                ->limit(10)
                ->get();
        }

        // Top movers (30d)
        $topMovers = DB::table('stock_movements as m')
            ->select('m.product_id', DB::raw('COUNT(*) as cnt'))
            ->where('m.created_at', '>=', now()->subDays(30))
            ->groupBy('m.product_id')
            ->orderByDesc('cnt')
            ->limit(10)
            ->get()
            ->map(function($item) {
                $item->product = DB::table('products')->find($item->product_id);
                return $item;
            });

        // Recent movements
        $recentMovements = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->select('m.id', 'm.type', 'm.qty', 'm.created_at', 'p.sku', 'w.code')
            ->orderByDesc('m.created_at')
            ->limit(10)
            ->get()
            ->map(function($item) {
                $item->created_at = \Carbon\Carbon::parse($item->created_at);
                return $item;
            });

        return compact(
            'usersCount',
            'productsCount', 
            'warehousesCount',
            'openPoCount',
            'openPoDueSoon',
            'mvSummary',
            'lowStockCount',
            'lowStock',
            'pendingApprovals',
            'stockByWh',
            'recent',
            'topMovers',
            'recentMovements'
        );
    }

    private function getManagerData()
    {
        $data = $this->getAdminData();
        return $data;
    }

    private function getClerkData()
    {
        // Items pending receipt from POs
        $toReceive = collect([]);
        $openPoCount = 0;
        $openPoDueSoon = 0;
        
        if (DB::getSchemaBuilder()->hasTable('purchase_orders') && 
            DB::getSchemaBuilder()->hasTable('purchase_order_items')) {
            
            $toReceive = DB::table('purchase_order_items as poi')
                ->join('purchase_orders as po', 'po.id', '=', 'poi.purchase_order_id')
                ->join('products as p', 'p.id', '=', 'poi.product_id')
                ->join('warehouses as w', 'w.id', '=', 'poi.warehouse_id')
                ->select(
                    'poi.id',
                    'po.po_number',
                    'po.expected_date',
                    'p.sku',
                    'p.name as product_name',
                    'w.code as wh_code',
                    DB::raw('(poi.qty_ordered - poi.qty_received) as remaining')
                )
                ->whereIn('po.status', ['SENT', 'APPROVED'])
                ->whereRaw('poi.qty_received < poi.qty_ordered')
                ->orderBy('po.expected_date')
                ->limit(10)
                ->get();

            $openPoCount = DB::table('purchase_orders')
                ->whereIn('status', ['DRAFT', 'SENT'])
                ->count();

            $openPoDueSoon = DB::table('purchase_orders')
                ->whereIn('status', ['DRAFT', 'SENT'])
                ->whereDate('expected_date', '<=', now()->addDays(7))
                ->count();
        }

        // Recent movements by this user
        $recentMovements = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->select(
                'm.id',
                'm.type',
                'm.qty',
                'm.reference',
                'm.created_at',
                'p.sku',
                'p.name as product_name',
                'w.code as code'
            )
            ->where('m.user_id', auth()->id())
            ->orderByDesc('m.created_at')
            ->limit(10)
            ->get()
            ->map(function($item) {
                $item->created_at = \Carbon\Carbon::parse($item->created_at);
                return $item;
            });

        // Count of items to receive
        $toReceiveCount = $toReceive->count();

        return compact('toReceive', 'recentMovements', 'toReceiveCount', 'openPoCount', 'openPoDueSoon');
    }

    private function getViewerData()
    {
        $productsCount = DB::table('products')->count();
        $warehousesCount = DB::table('warehouses')->count();

        // Low stock count
        $lowStockCount = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->count();

        // Low stock items (top 10)
        $lowStock = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select('p.sku', 'p.name', 'w.code as wh', 'il.on_hand', 'p.reorder_point')
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC')
            ->limit(10)
            ->get();

        // Stock by warehouse
        $stockByWh = DB::table('inventory_levels as il')
            ->join('warehouses as w', 'w.id', '=', 'il.warehouse_id')
            ->select('w.code', DB::raw('SUM(il.on_hand) as qty'))
            ->groupBy('w.id', 'w.code')
            ->orderBy('w.code')
            ->get();

        // Recent movements (last 10) - FIX: Add product_name to select
        $recentMovements = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->select(
                'm.id',
                'm.type',
                'm.qty',
                'm.reference',
                'm.created_at',
                'p.sku',
                'p.name as product_name',  // ← ADD THIS LINE
                'w.code'
            )
            ->orderByDesc('m.created_at')
            ->limit(10)
            ->get()
            ->map(function($item) {
                $item->created_at = \Carbon\Carbon::parse($item->created_at);
                return $item;
            });

        return compact('productsCount', 'warehousesCount', 'lowStockCount', 'lowStock', 'stockByWh', 'recentMovements');
    }
}