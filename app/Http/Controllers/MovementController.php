<?php
// app/Http/Controllers/MovementController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\StockMovement;
use App\Models\InventoryLevel;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));

        $items = DB::table('stock_movements as m')
            ->join('products as p', 'p.id', '=', 'm.product_id')
            ->join('warehouses as w', 'w.id', '=', 'm.warehouse_id')
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->select(
                'm.id',
                'm.type',
                'm.qty',
                'm.reference',
                'm.created_at',
                'p.sku',
                'p.name as product_name',
                'w.code as wh_code',
                'w.name as wh_name',
                'u.name as user_name'
            )
            ->when($q, function ($query) use ($q) {
                $query->where('p.sku', 'like', "%{$q}%")
                      ->orWhere('p.name', 'like', "%{$q}%")
                      ->orWhere('m.reference', 'like', "%{$q}%");
            })
            ->orderByDesc('m.created_at')
            ->limit(50)
            ->get();

        $isViewer = auth()->user()->role === 'Viewer';

        return view('movements.index', compact('items', 'q', 'isViewer'));
    }

    public function create()
    {
        return view('movements.create', [
            'products'    => Product::orderBy('sku')->get(['id','sku','name']),
            'warehouses'  => Warehouse::orderBy('code')->get(['id','code','name']),
        ]);
    }

    public function store(Request $request)
    {
        // Step 1: Validate basic fields
        $validated = $request->validate([
            'product_id' => ['required','exists:products,id'],
            'type'       => ['required','in:IN,OUT,TRANSFER,ADJUST'],
            'qty'        => ['required','integer','min:1'],
            'reference'  => ['nullable','string','max:50'],
            'notes'      => ['nullable','string','max:500'],
        ]);

        // Step 2: Determine which warehouse field to use based on type
        $type = $validated['type'];
        
        if ($type === 'OUT' || $type === 'TRANSFER') {
            // For OUT/TRANSFER, use "From Warehouse"
            $request->validate([
                'from_warehouse_id' => ['required','exists:warehouses,id'],
            ]);
            $warehouseId = $request->from_warehouse_id;
        } else {
            // For IN/ADJUST, use "To Warehouse"
            $request->validate([
                'to_warehouse_id' => ['required','exists:warehouses,id'],
            ]);
            $warehouseId = $request->to_warehouse_id;
        }

        // Step 3: Create movement record
        DB::transaction(function () use ($validated, $warehouseId) {
            // Create stock movement
            StockMovement::create([
                'product_id'   => $validated['product_id'],
                'warehouse_id' => $warehouseId,
                'type'         => $validated['type'],
                'qty'          => $validated['qty'],
                'reference'    => $validated['reference'],
                'notes'        => $validated['notes'],
                'user_id'      => auth()->id(),
            ]);

            // Update inventory level
            $type = $validated['type'];
            $productId = $validated['product_id'];
            $qty = $validated['qty'];

            if ($type === 'IN' || $type === 'ADJUST') {
                // Add stock
                DB::statement('
                    INSERT INTO inventory_levels (product_id, warehouse_id, on_hand, created_at, updated_at)
                    VALUES (?, ?, ?, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE on_hand = on_hand + ?, updated_at = NOW()
                ', [$productId, $warehouseId, $qty, $qty]);
            } elseif ($type === 'OUT') {
                // Reduce stock
                DB::statement('
                    UPDATE inventory_levels 
                    SET on_hand = GREATEST(0, on_hand - ?), updated_at = NOW()
                    WHERE product_id = ? AND warehouse_id = ?
                ', [$qty, $productId, $warehouseId]);
            }
            // Note: TRANSFER should be handled separately with from/to warehouses
        });

        return redirect()
            ->route('movements.index')
            ->with('success', 'Stock movement recorded successfully.');
    }
}
