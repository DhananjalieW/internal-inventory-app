<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;  // Add this line

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q',''));
        $products = Product::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('sku','like',"%{$q}%")
                      ->orWhere('name','like',"%{$q}%");
            })
            ->orderBy('sku')
            ->paginate(12)
            ->withQueryString();

        $isViewer = auth()->user()->role === 'Viewer';

        return view('products.index', compact('products','q', 'isViewer'));
    }

    public function create()
    {
        $categories = config('product_meta.categories');
        $uoms       = config('product_meta.uoms');
        
        // Generate next SKU
        $nextSku = $this->generateNextSku();
        
        return view('products.create', compact('categories','uoms', 'nextSku'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sku'           => ['nullable','string','max:64','unique:products,sku'], // Make SKU nullable
            'name'          => ['required','string','max:255'],
            'description'   => ['nullable','string'],
            'category'      => ['required', Rule::in(config('product_meta.categories'))],
            'uom'           => ['required', Rule::in(config('product_meta.uoms'))],
            'reorder_point' => ['required','integer','min:0'],
            'is_active'     => ['required','boolean'],
        ]);

        // Auto-generate SKU if not provided
        if (empty($data['sku'])) {
            $data['sku'] = $this->generateNextSku();
        }

        $product = Product::create($data);

        ActivityLog::create([
            'user_id'      => auth()->id(),
            'event'        => 'PRODUCT_CREATE',
            'subject_type' => Product::class,
            'subject_id'   => $product->id,
            'description'  => "Created product {$product->sku}",
        ]);

        return redirect()->route('products.index')->with('success','Product created.');
    }

    /**
     * Generate next SKU in format: PRD-00001, PRD-00002, etc.
     */
    private function generateNextSku()
    {
        $latestProduct = DB::table('products')
            ->orderByDesc('id')
            ->first();
        
        if (!$latestProduct) {
            return 'PRD-00001';
        }

        // Extract number from last SKU
        $lastSku = $latestProduct->sku;
        
        // If SKU follows PRD-XXXXX format
        if (preg_match('/PRD-(\d+)/', $lastSku, $matches)) {
            $nextNum = (int)$matches[1] + 1;
        } else {
            // Fallback: use product ID
            $nextNum = $latestProduct->id + 1;
        }
        
        return 'PRD-' . str_pad($nextNum, 5, '0', STR_PAD_LEFT);
    }

    public function edit(Product $product)
    {
        $categories = config('product_meta.categories');
        $uoms       = config('product_meta.uoms');
        return view('products.edit', compact('product','categories','uoms'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'sku'           => ['required','string','max:64', Rule::unique('products','sku')->ignore($product->id)],
            'name'          => ['required','string','max:255'],
            'description'   => ['nullable','string'],
            'category'      => ['required', Rule::in(config('product_meta.categories'))],
            'uom'           => ['required', Rule::in(config('product_meta.uoms'))],
            'reorder_point' => ['required','integer','min:0'],
            'is_active'     => ['required','boolean'],
        ]);

        $product->update($data);

        ActivityLog::create([
            'user_id'      => auth()->id(),
            'event'        => 'PRODUCT_UPDATE',
            'subject_type' => Product::class,
            'subject_id'   => $product->id,
            'description'  => "Updated product {$product->sku}",
        ]);

        return redirect()->route('products.index')->with('success','Product updated.');
    }

    public function destroy(Product $product)
    {
        $sku = $product->sku;
        $id  = $product->id;
        $product->delete();

        ActivityLog::create([
            'user_id'      => auth()->id(),
            'event'        => 'PRODUCT_DELETE',
            'subject_type' => Product::class,
            'subject_id'   => $id,
            'description'  => "Deleted product {$sku}",
        ]);

        return redirect()->route('products.index')->with('success','Product deleted.');
    }
}
