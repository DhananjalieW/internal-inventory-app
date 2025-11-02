<?php
// filepath: c:\projects\internal-inventory-app\app\Http\Controllers\TransferController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Show the form to create a new transfer request
     */
    public function create()
    {
        $products = DB::table('products')
            ->where('is_active', true)
            ->orderBy('sku')
            ->get(['id', 'sku', 'name']);

        $warehouses = DB::table('warehouses')
            ->where('is_active', true)
            ->orderBy('code')
            ->get(['id', 'code', 'name']);

        return view('transfers.create', compact('products', 'warehouses'));
    }

    /**
     * Store a new transfer request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'        => ['required', 'exists:products,id'],
            'from_warehouse_id' => ['required', 'exists:warehouses,id'],
            'to_warehouse_id'   => ['required', 'exists:warehouses,id', 'different:from_warehouse_id'],
            'qty'               => ['required', 'integer', 'min:1'],
            'reference'         => ['nullable', 'string', 'max:100'],
            'notes'             => ['nullable', 'string', 'max:500'],
        ]);

        // Create a transfer request (stored as a movement with status 'pending')
        DB::table('stock_movements')->insert([
            'product_id'   => $data['product_id'],
            'warehouse_id' => $data['from_warehouse_id'],
            'type'         => 'TRANSFER_REQ',
            'qty'          => -$data['qty'], // negative for "from"
            'reference'    => $data['reference'] ?? 'Transfer Request',
            'notes'        => json_encode([
                'to_warehouse_id' => $data['to_warehouse_id'],
                'notes'           => $data['notes'] ?? null,
                'status'          => 'pending',
            ]),
            'user_id'      => auth()->id(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()
            ->route('transfers.my')
            ->with('success', 'Transfer request submitted successfully.');
    }

    /**
     * Show user's own transfer requests
     */
    public function my(Request $request)
    {
        $q = trim($request->get('q', ''));
        $status = $request->get('status', 'all');
        $dateFrom = $request->get('from');
        $dateTo = $request->get('to');

        $items = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as wh_from', 'wh_from.id', '=', 'm.warehouse_id')
            ->select(
                'm.id',
                'm.created_at',
                'm.qty',
                'm.reference',
                'm.notes',
                'p.sku',
                'p.name as product',
                'wh_from.code as from_code'
            )
            ->where('m.type', 'TRANSFER_REQ')
            ->where('m.user_id', auth()->id())
            ->when($q, function ($query) use ($q) {
                $like = "%{$q}%";
                $query->where(function ($x) use ($like) {
                    $x->where('p.sku', 'like', $like)
                      ->orWhere('p.name', 'like', $like)
                      ->orWhere('m.reference', 'like', $like);
                });
            })
            ->when($status !== 'all', function ($query) use ($status) {
                $query->whereRaw("JSON_EXTRACT(m.notes, '$.status') = ?", [$status]);
            })
            ->when($dateFrom, fn($q) => $q->whereDate('m.created_at', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('m.created_at', '<=', $dateTo))
            ->orderByDesc('m.created_at')
            ->paginate(20)
            ->withQueryString();

        // Parse JSON notes for each item
        foreach ($items as $item) {
            $notes = json_decode($item->notes, true);
            $item->to_warehouse_id = $notes['to_warehouse_id'] ?? null;
            $item->status = $notes['status'] ?? 'pending';
            
            if ($item->to_warehouse_id) {
                $toWh = DB::table('warehouses')->find($item->to_warehouse_id);
                $item->to_code = $toWh->code ?? '—';
            } else {
                $item->to_code = '—';
            }
        }

        return view('transfers.my', compact('items', 'q', 'status', 'dateFrom', 'dateTo'));
    }
}