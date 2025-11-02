<?php
// filepath: c:\projects\internal-inventory-app\app\Http\Controllers\Admin\TransferAdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransferAdminController extends Controller
{
    /**
     * Show pending transfer requests (Admin/Manager only)
     */
    public function index()
    {
        $items = DB::table('stock_movements as m')
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
                'p.name as product',
                'wh_from.code as from_code',
                'u.name as requested_by'
            )
            ->where('m.type', 'TRANSFER_REQ')
            ->whereRaw("JSON_EXTRACT(m.notes, '$.status') = 'pending'")
            ->orderByDesc('m.created_at')
            ->get();

        // Parse JSON notes
        foreach ($items as $item) {
            $notes = json_decode($item->notes, true);
            $item->to_warehouse_id = $notes['to_warehouse_id'] ?? null;
            
            if ($item->to_warehouse_id) {
                $toWh = DB::table('warehouses')->find($item->to_warehouse_id);
                $item->to_code = $toWh->code ?? '—';
            } else {
                $item->to_code = '—';
            }
        }

        return view('admin.transfers.index', compact('items'));
    }

    /**
     * Approve a transfer request
     */
    public function approve($id)
    {
        $movement = DB::table('stock_movements')->find($id);
        
        if (!$movement || $movement->type !== 'TRANSFER_REQ') {
            return back()->with('error', 'Transfer request not found.');
        }

        $notes = json_decode($movement->notes, true);
        $toWarehouseId = $notes['to_warehouse_id'] ?? null;

        if (!$toWarehouseId) {
            return back()->with('error', 'Invalid transfer data.');
        }

        DB::beginTransaction();
        try {
            // Update status to approved
            $notes['status'] = 'approved';
            $notes['approved_by'] = auth()->id();
            $notes['approved_at'] = now()->toDateTimeString();
            
            DB::table('stock_movements')
                ->where('id', $id)
                ->update([
                    'notes'      => json_encode($notes),
                    'updated_at' => now(),
                ]);

            // Create the actual transfer movements
            $qty = abs($movement->qty);

            // OUT from source warehouse
            DB::table('stock_movements')->insert([
                'product_id'   => $movement->product_id,
                'warehouse_id' => $movement->warehouse_id,
                'type'         => 'OUT',
                'qty'          => -$qty,
                'reference'    => "Transfer: {$movement->reference}",
                'notes'        => "Approved transfer #{$id}",
                'user_id'      => auth()->id(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            // IN to destination warehouse
            DB::table('stock_movements')->insert([
                'product_id'   => $movement->product_id,
                'warehouse_id' => $toWarehouseId,
                'type'         => 'IN',
                'qty'          => $qty,
                'reference'    => "Transfer: {$movement->reference}",
                'notes'        => "Approved transfer #{$id}",
                'user_id'      => auth()->id(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            DB::statement('
                UPDATE inventory_levels 
                SET on_hand = GREATEST(0, on_hand - ?), updated_at = NOW()
                WHERE product_id = ? AND warehouse_id = ?
            ', [$qty, $movement->product_id, $movement->warehouse_id]);

            DB::statement('
                INSERT INTO inventory_levels (product_id, warehouse_id, on_hand, created_at, updated_at)
                VALUES (?, ?, ?, NOW(), NOW())
                ON DUPLICATE KEY UPDATE on_hand = on_hand + ?, updated_at = NOW()
            ', [$movement->product_id, $toWarehouseId, $qty, $qty]);

            DB::commit();

            return back()->with('success', 'Transfer approved successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed: ' . $e->getMessage());
        }
    }

    /**
     * Reject a transfer request
     */
    public function reject($id)
    {
        $movement = DB::table('stock_movements')->find($id);
        
        if (!$movement || $movement->type !== 'TRANSFER_REQ') {
            return back()->with('error', 'Transfer request not found.');
        }

        $notes = json_decode($movement->notes, true);
        $notes['status'] = 'rejected';
        $notes['rejected_by'] = auth()->id();
        $notes['rejected_at'] = now()->toDateTimeString();

        DB::table('stock_movements')
            ->where('id', $id)
            ->update([
                'notes' => json_encode($notes),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Transfer request rejected.');
    }
}