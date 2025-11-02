<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    public function index()
    {
        $rows = Warehouse::orderBy('name')->paginate(12);
        $isViewer = auth()->user()->role === 'Viewer';
        return view('warehouses.index', compact('rows', 'isViewer'));
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'     => ['required','string','max:20','unique:warehouses,code'],
            'name'     => ['required','string','max:255'],
            'location' => ['nullable','string','max:255'],
            'is_active'=> ['required','boolean'],
        ]);

        Warehouse::create($data);
        return redirect()->route('warehouses.index')->with('success','Warehouse created.');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $data = $request->validate([
            'code'     => ['required','string','max:20', Rule::unique('warehouses','code')->ignore($warehouse->id)],
            'name'     => ['required','string','max:255'],
            'location' => ['nullable','string','max:255'],
            'is_active'=> ['required','boolean'],
        ]);

        $warehouse->update($data);
        return redirect()->route('warehouses.index')->with('success','Warehouse updated.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return back()->with('success','Warehouse deleted.');
    }
}
