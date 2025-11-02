<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Mail\POSentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));
        
        // Check if the user can manage POs (Admin or Manager)
        $canManage = in_array(auth()->user()->role ?? '', ['Admin', 'Inventory Manager']);

        $pos = DB::table('purchase_orders as po')
            ->leftJoin('suppliers as s', 's.id', '=', 'po.supplier_id')
            ->select(
                'po.id',
                'po.po_number',
                'po.status',
                'po.order_date',
                'po.expected_date',
                'po.created_at',
                's.name as supplier_name'
            )
            ->when($q, function ($query) use ($q) {
                $like = "%{$q}%";
                $query->where(function ($x) use ($like) {
                    $x->where('po.po_number', 'like', $like)
                      ->orWhere('s.name', 'like', $like);
                });
            })
            ->orderByDesc('po.created_at')
            ->paginate(15)
            ->withQueryString();

        // Add items count AND items collection to each PO
        foreach ($pos as $po) {
            // Get items count
            $po->items_count = DB::table('purchase_order_items')
                ->where('purchase_order_id', $po->id)
                ->count();
            
            // Get items for receiving
            $po->items = DB::table('purchase_order_items as poi')
                ->join('products as p', 'p.id', '=', 'poi.product_id')
                ->join('warehouses as w', 'w.id', '=', 'poi.warehouse_id')
                ->select(
                    'poi.id',
                    'poi.product_id',
                    'poi.warehouse_id',
                    'poi.qty_ordered',
                    'poi.received_qty',
                    'poi.price',
                    'p.sku',
                    'p.name as product_name',
                    'w.code as wh_code'
                )
                ->where('poi.purchase_order_id', $po->id)
                ->get();
        }

        return view('pos.index', compact('pos', 'q', 'canManage'));
    }

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

        $suppliers = DB::table('suppliers')
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        return view('pos.create', compact('products', 'warehouses', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id'   => ['required', 'exists:suppliers,id'],
            'order_date'    => ['required', 'date'],
            'expected_date' => ['nullable', 'date', 'after_or_equal:order_date'],
            'notes'         => ['nullable', 'string', 'max:1000'],
            'items'         => ['required', 'array', 'min:1'],
            'items.*.product_id'   => ['required', 'exists:products,id'],
            'items.*.warehouse_id' => ['required', 'exists:warehouses,id'],
            'items.*.qty'          => ['required', 'integer', 'min:1'],
            'items.*.price'        => ['required', 'numeric', 'min:0'],
        ]);

        DB::beginTransaction();
        try {
            // Generate PO number
            $latestPo = DB::table('purchase_orders')
                ->orderByDesc('id')
                ->first();
            
            $nextNum = $latestPo ? ((int) substr($latestPo->po_number, 3)) + 1 : 1;
            $poNumber = 'PO-' . str_pad($nextNum, 5, '0', STR_PAD_LEFT);

            // Create PO
            $poId = DB::table('purchase_orders')->insertGetId([
                'po_number'     => $poNumber,
                'supplier_id'   => $data['supplier_id'],
                'order_date'    => $data['order_date'],
                'expected_date' => $data['expected_date'] ?? null,
                'notes'         => $data['notes'] ?? null,
                'status'        => 'DRAFT',
                'created_by'    => auth()->id(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // Create PO items
            foreach ($data['items'] as $item) {
                DB::table('purchase_order_items')->insert([
                    'purchase_order_id' => $poId,
                    'product_id'        => $item['product_id'],
                    'warehouse_id'      => $item['warehouse_id'],
                    'qty_ordered'       => $item['qty'],
                    'price'             => $item['price'],
                    'received_qty'      => 0,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }

            // Log activity
            DB::table('activity_log')->insert([
                'user_id'      => auth()->id(),
                'event'        => 'PO_CREATE',
                'subject_type' => 'App\Models\PurchaseOrder',
                'subject_id'   => $poId,
                'description'  => "Created PO {$poNumber}",
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            DB::commit();

            return redirect()
                ->route('pos.index')
                ->with('success', "Purchase order {$poNumber} created successfully.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Failed to create purchase order: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        DB::table('purchase_orders')
            ->where('id', $id)
            ->update([
                'status'     => 'APPROVED',
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Purchase order approved.');
    }

    public function send($id)
    {
        // Get PO with supplier details
        $po = DB::table('purchase_orders as po')
            ->leftJoin('suppliers as s', 's.id', '=', 'po.supplier_id')
            ->select(
                'po.*',
                's.name as supplier_name',
                's.email as supplier_email'
            )
            ->where('po.id', $id)
            ->first();

        if (!$po) {
            return back()->with('error', 'Purchase order not found.');
        }

        // Get PO items
        $items = DB::table('purchase_order_items as poi')
            ->join('products as p', 'p.id', '=', 'poi.product_id')
            ->join('warehouses as w', 'w.id', '=', 'poi.warehouse_id')
            ->select(
                'poi.*',
                'p.sku',
                'p.name as product_name',
                'w.code as wh_code',
                'w.name as wh_name'
            )
            ->where('poi.purchase_order_id', $id)
            ->get();

        // Update status to SENT
        DB::table('purchase_orders')
            ->where('id', $id)
            ->update([
                'status'     => 'SENT',
                'updated_at' => now(),
            ]);

        // Send email if supplier has an email
        if ($po->supplier_email) {
            try {
                Mail::to($po->supplier_email)->send(
                    new POSentMail($po, $items, $po->supplier_name)
                );
                
                return back()->with('success', "Purchase order marked as sent. Email sent to {$po->supplier_email}");
            } catch (\Exception $e) {
                return back()->with('warning', "PO marked as sent, but email failed: {$e->getMessage()}");
            }
        }

        return back()->with('warning', 'Purchase order marked as sent, but supplier has no email address.');
    }

    public function cancel($id)
    {
        DB::table('purchase_orders')
            ->where('id', $id)
            ->update([
                'status'     => 'CANCELLED',
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Purchase order cancelled.');
    }

    public function receiveForm($itemId)
    {
        $item = DB::table('purchase_order_items as poi')
            ->join('purchase_orders as po', 'po.id', '=', 'poi.purchase_order_id')
            ->join('products as p', 'p.id', '=', 'poi.product_id')
            ->join('warehouses as w', 'w.id', '=', 'poi.warehouse_id')
            ->select(
                'poi.*',
                'po.po_number',
                'p.sku',
                'p.name as product_name',
                'w.code as wh_code',
                'w.name as wh_name'
            )
            ->where('poi.id', $itemId)
            ->first();

        if (!$item) {
            return redirect()->route('pos.index')->with('error', 'Item not found.');
        }

        $remaining = max(0, (int)$item->qty_ordered - (int)$item->received_qty);

        return view('pos.receive', compact('item', 'remaining'));
    }

    public function receiveStore(Request $request, $itemId)
    {
        $item = DB::table('purchase_order_items')->find($itemId);
        
        if (!$item) {
            return back()->with('error', 'Item not found.');
        }

        $remaining = max(0, (int)$item->qty_ordered - (int)$item->received_qty);

        $data = $request->validate([
            'qty'       => ['required', 'integer', 'min:1', 'max:' . $remaining],
            'reference' => ['nullable', 'string', 'max:100'],
            'notes'     => ['nullable', 'string', 'max:500'],
        ]);

        DB::beginTransaction();
        try {
            // Update received qty
            DB::table('purchase_order_items')
                ->where('id', $itemId)
                ->increment('received_qty', $data['qty']);

            // Create stock movement (IN)
            DB::table('stock_movements')->insert([
                'product_id'   => $item->product_id,
                'warehouse_id' => $item->warehouse_id,
                'type'         => 'IN',
                'qty'          => $data['qty'],
                'reference'    => $data['reference'] ?? "PO Item #{$itemId}",
                'notes'        => $data['notes'] ?? null,
                'user_id'      => auth()->id(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            // Update inventory level
            $level = DB::table('inventory_levels')
                ->where('product_id', $item->product_id)
                ->where('warehouse_id', $item->warehouse_id)
                ->first();

            if ($level) {
                DB::table('inventory_levels')
                    ->where('id', $level->id)
                    ->increment('on_hand', $data['qty']);
            } else {
                DB::table('inventory_levels')->insert([
                    'product_id'   => $item->product_id,
                    'warehouse_id' => $item->warehouse_id,
                    'on_hand'      => $data['qty'],
                    'on_order'     => 0,
                    'allocated'    => 0,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }

            // Check if PO is fully received
            $po = DB::table('purchase_orders')->find($item->purchase_order_id);
            $allItems = DB::table('purchase_order_items')
                ->where('purchase_order_id', $po->id)
                ->get();

            $fullyReceived = $allItems->every(function ($i) {
                return (int)$i->received_qty >= (int)$i->qty_ordered;
            });

            if ($fullyReceived) {
                DB::table('purchase_orders')
                    ->where('id', $po->id)
                    ->update(['status' => 'CLOSED', 'updated_at' => now()]);
            }

            DB::commit();

            return redirect()
                ->route('pos.index')
                ->with('success', "Received {$data['qty']} units successfully.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Failed to receive items: ' . $e->getMessage());
        }
    }
}
