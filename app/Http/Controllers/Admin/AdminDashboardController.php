<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // KPIs
        $usersCount       = DB::table('users')->count();
        $productsCount    = DB::table('products')->count();
        $warehousesCount  = DB::table('warehouses')->count();
        $openPoCount      = DB::table('purchase_orders')->whereIn('status', ['DRAFT','SENT'])->count();
        
        // Fix: Use correct column names (on_hand instead of qty_on_hand)
        $lowStockCount    = DB::table('inventory_levels as il')
            ->join('products as p', 'p.id', '=', 'il.product_id')
            ->whereColumn('il.on_hand', '<', 'p.reorder_point')
            ->count();

        // Low stock (top 10) - also fix column names here
        $lowStock = DB::table('inventory_levels as il')
            ->join('products as p','p.id','=','il.product_id')
            ->join('warehouses as w','w.id','=','il.warehouse_id')
            ->select('p.sku','p.name','w.code as wh','il.on_hand','p.reorder_point')
            ->whereColumn('il.on_hand','<','p.reorder_point')
            ->orderByRaw('(p.reorder_point - il.on_hand) DESC')
            ->limit(10)->get();

        // Pending approvals (examples: adjustments/transfers, POs)
        $pendingTransfers = DB::table('stock_movements')
            ->where('type', 'TRANSFER_REQ') // ← RESTORED
            ->whereRaw("JSON_EXTRACT(notes, '$.status') = 'pending'")
            ->count(); // if you gate requests
        $pendingAdjust    = DB::table('stock_movements')
            ->where('type', 'ADJUST')
            ->whereRaw("JSON_EXTRACT(notes, '$.status') = 'pending'")
            ->count();   // if you gate requests

        // Recent activity (from our activity_log table in step 4)
        $recent = DB::table('activity_log')
            ->orderByDesc('id')->limit(10)->get();

        return view('admin.dashboard', compact(
            'usersCount','productsCount','warehousesCount','openPoCount',
            'lowStockCount','lowStock','pendingTransfers','pendingAdjust','recent'
        ));
    }
}
