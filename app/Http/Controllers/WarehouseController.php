<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Product;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the warehouses.
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('store.index')->with('warehouses',$warehouses);
    }

    /**
     * Show the form for creating a new warehouse.
     */
    public function create()
    {
        return view('store.add');
    }

    /**
     * Store a newly created warehouse in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:warehouses,name'], // Array format
            'location' => 'nullable|string', // String format
            'capacity' => ['required', 'integer', 'min:0'], // Array format
            'status' => ['required', 'string'], // Array format
        ]);

        Warehouse::create($validated);

        return redirect()->route('store.index')->with('success', 'Warehouse created successfully!');
    }

    /**
     * Display the specified warehouse.
     */
    public function show(Warehouse $warehouse)
    {
        $warehouse->load('products');
        return view('warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified warehouse.
     */
    public function edit(string $id)
    {

         // Find the warehouse by ID
         $warehouse = Warehouse::findOrFail($id);
        return view('store.edit', compact('warehouse'));
    }

    /**
     * Update the specified warehouse in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:warehouses,name'], // Array format
            'location' => 'nullable|string', // String format
            'capacity' => ['required', 'integer', 'min:0'], // Array format
            'status' => ['required', 'string'], // Array format
        ]);
        // Find the warehouse by ID
        $warehouse = Warehouse::findOrFail($id);

        $warehouse->update($validated);

        return redirect()->route('store.index')->with('success', 'Warehouse updated successfully!');
    }

    /**
     * Remove the specified warehouse from storage.
     */
    public function destroy(string $id)
    {
        

        $warehouse = warehouse::find($id);

        if (!$warehouse) {
            return response()->json(['success' => false, 'message' => 'warehouse not found.']);
        }
    
        $warehouse->delete();
    
        return response()->json(['success' => true, 'message' => 'Warehouse deleted successfully.']);
    }

    /**
     * Add or update a product in a warehouse.
     */
    public function addProduct(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $warehouse->products()->syncWithoutDetaching([
            $validated['product_id'] => ['quantity' => $validated['quantity']],
        ]);

        return redirect()->back()->with('success', 'Product added/updated in the warehouse successfully!');
    }
}
