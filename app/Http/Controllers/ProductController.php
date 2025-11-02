<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        return view('products.create', compact('categories','uoms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sku'           => ['required','string','max:64','unique:products,sku'],
            'name'          => ['required','string','max:255'],
            'description'   => ['nullable','string'],
            'category'      => ['required', Rule::in(config('product_meta.categories'))],
            'uom'           => ['required', Rule::in(config('product_meta.uoms'))],
            'reorder_point' => ['required','integer','min:0'],
            'is_active'     => ['required','boolean'],
        ]);

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
