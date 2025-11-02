<?php
// filepath: c:\projects\internal-inventory-app\app\Http\Controllers\SupplierController.php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->paginate(12);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'contact'  => ['nullable','string','max:255'],
            'email'    => ['nullable','email','max:255'],
            'phone'    => ['nullable','string','max:50'],
            'address'  => ['nullable','string'],
            'is_active'=> ['required','boolean'],
        ]);

        Supplier::create($data);
        return redirect()->route('suppliers.index')->with('success','Supplier created.');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'contact'  => ['nullable','string','max:255'],
            'email'    => ['nullable','email','max:255'],
            'phone'    => ['nullable','string','max:50'],
            'address'  => ['nullable','string'],
            'is_active'=> ['required','boolean'],
        ]);

        $supplier->update($data);
        return redirect()->route('suppliers.index')->with('success','Supplier updated.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('success','Supplier deleted.');
    }
}