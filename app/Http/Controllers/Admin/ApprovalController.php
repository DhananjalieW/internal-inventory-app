<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        // Pending adjustments (movements)
        $pendingMovements = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->join('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.id',
                'm.type',
                'm.qty',
                'm.reference',
                'm.notes',
                'm.created_at',
                'p.sku',
                'p.name as product_name',
                'w.code as warehouse_code',
                'u.name as user_name'
            )
            ->where('m.type', 'ADJUST')
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(m.notes, '$.status')) = 'pending'")
            ->orderByDesc('m.created_at')
            ->get();

        // Pending transfer requests
        $pendingTransfers = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as wh_from', 'wh_from.id', '=', 'm.warehouse_id')
            ->join('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.id',
                'm.created_at',
                'm.qty',
                'm.reference',
                'm.notes',
                'p.sku',
                'p.name as product_name',
                'wh_from.code as from_warehouse',
                'u.name as requested_by'
            )
            ->where('m.type', 'TRANSFER_REQ')
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(m.notes, '$.status')) = 'pending'")
            ->orderByDesc('m.created_at')
            ->get();

        // attach "to" warehouse
        foreach ($pendingTransfers as $t) {
            $notes = json_decode($t->notes, true) ?? [];
            $toId  = $notes['to_warehouse_id'] ?? null;
            $t->to_warehouse = $toId ? (DB::table('warehouses')->find($toId)->code ?? '—') : '—';
        }

        // Pending POs (drafts)
        $pendingPOs = DB::table('purchase_orders as po')
            ->leftJoin('suppliers as s', 's.id', '=', 'po.supplier_id')
            ->select(
                'po.id',
                'po.po_number',
                'po.order_date',
                'po.expected_date',
                'po.created_at',
                's.name as supplier_name'
            )
            ->where('po.status', 'DRAFT')
            ->orderByDesc('po.created_at')
            ->get();

        // Unified list
        $list = collect([])
            ->merge($pendingMovements->map(function ($r) {
                return (object) [
                    'id'            => $r->id,
                    'type'          => 'movement',          // for form actions
                    'movement_type' => $r->type,            // ADJUST
                    'created_at'    => $r->created_at,
                    'user'          => $r->user_name,
                    'sku'           => $r->sku,
                    'product'       => $r->product_name,
                    'warehouse'     => $r->warehouse_code,
                    'qty'           => $r->qty,
                    'reference'     => $r->reference ?? '—',
                ];
            }))
            ->merge($pendingTransfers->map(function ($r) {
                return (object) [
                    'id'            => $r->id,
                    'type'          => 'transfer',          // for form actions
                    'movement_type' => 'TRANSFER',
                    'created_at'    => $r->created_at,
                    'user'          => $r->requested_by,
                    'sku'           => $r->sku,
                    'product'       => $r->product_name,
                    'warehouse'     => $r->from_warehouse . ' → ' . $r->to_warehouse,
                    'qty'           => abs($r->qty),
                    'reference'     => $r->reference ?? '—',
                ];
            }))
            ->merge($pendingPOs->map(function ($r) {
                return (object) [
                    'id'            => $r->id,
                    'type'          => 'purchase_order',    // for form actions
                    'movement_type' => 'PO',
                    'created_at'    => $r->created_at,
                    'user'          => '—',
                    'sku'           => $r->po_number,
                    'product'       => 'Purchase Order',
                    'warehouse'     => $r->supplier_name ?? '—',
                    'qty'           => '—',
                    'reference'     => $r->expected_date ?? '—',
                ];
            }))
            ->sortByDesc('created_at')
            ->values();

        return view('admin.approvals.index', compact('list'));
    }

    public function approve($id)
    {
        $type = request()->get('type', 'movement');

        if ($type === 'movement') {
            $m = DB::table('stock_movements')->find($id);
            if (!$m) return back()->with('error','Movement not found.');

            $notes = json_decode($m->notes, true) ?? [];
            $notes['status']      = 'approved';
            $notes['approved_by'] = auth()->id();
            $notes['approved_at'] = now()->toDateTimeString();

            DB::table('stock_movements')->where('id',$id)->update([
                'notes'      => json_encode($notes),
                'updated_at' => now(),
            ]);

            if ($m->type === 'ADJUST') {
                DB::statement('
                    INSERT INTO inventory_levels (product_id, warehouse_id, on_hand, created_at, updated_at)
                    VALUES (?, ?, ?, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE on_hand = on_hand + ?, updated_at = NOW()
                ', [$m->product_id, $m->warehouse_id, $m->qty, $m->qty]);
            }

            return back()->with('success','Request approved.');
        }

        if ($type === 'transfer') {
            return redirect()->route('admin.transfers.approve', $id);
        }

        if ($type === 'purchase_order') {
            return redirect()->route('pos.approve', $id);
        }

        return back()->with('error','Unknown approval type.');
    }

    public function reject($id)
    {
        $type = request()->get('type', 'movement');

        if ($type === 'movement' || $type === 'transfer') {
            $m = DB::table('stock_movements')->find($id);
            if (!$m) return back()->with('error','Request not found.');

            $notes = json_decode($m->notes, true) ?? [];
            $notes['status']      = 'rejected';
            $notes['rejected_by'] = auth()->id();
            $notes['rejected_at'] = now()->toDateTimeString();

            DB::table('stock_movements')->where('id',$id)->update([
                'notes'      => json_encode($notes),
                'updated_at' => now(),
            ]);

            return back()->with('success','Request rejected.');
        }

        return back()->with('error','Unknown approval type.');
    }
}
