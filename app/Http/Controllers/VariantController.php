<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use App\Models\VariantValue;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variations = Variation::with('values')->get();

        return view('variant.index', compact('variations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('variant.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'values' => 'nullable|array', // Values can be optional
            'values.*' => 'required|string|max:255', // Each value must be a string
        ]);

        // Create the variation
        $variation = Variation::create(['name' => $validated['name']]);

        // Add the variant values
        if (isset($validated['values']) && is_array($validated['values'])) {
            foreach ($validated['values'] as $value) {
                VariantValue::create([
                    'variant_id' => $variation->id,
                    'value' => $value,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Variation and values  created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variation = Variation::with('values')->findOrFail($id); // Fetch the variation with its values
        return view('variant.edit', compact('variation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'values' => 'nullable|array', // Values can be optional
            'values.*' => 'required|string|max:255', // Each value must be a string
        ]);

        // Update variation name
        $variation = Variation::with('values')->findOrFail($id);
        $variation->update(['name' => $validated['name']]);

        // Sync variant values
        $existingValues = $variation->values->pluck('value')->toArray();
        $newValues = $validated['values'] ?? [];

        // Add new values
        foreach (array_diff($newValues, $existingValues) as $value) {
            VariantValue::create([
                'variant_id' => $variation->id,
                'value' => $value,
            ]);
        }

        // Delete removed values
        foreach (array_diff($existingValues, $newValues) as $value) {
            VariantValue::where('variant_id', $variation->id)->where('value', $value)->delete();
        }

        return redirect()->back()->with('success', 'Variation and values  updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variation = Variation::with('values')->findOrFail($id);
        $variation->delete();


        if (!$variation) {
            return response()->json(['success' => false, 'message' => 'Variation not found.']);
        }


        $variation->delete();

        return response()->json(['success' => true, 'message' => 'Variation deleted successfully.']);
    }
}
