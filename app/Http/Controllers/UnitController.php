<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return view('unit.index')->with('units', $units);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //
         $validatedData = $request->validate([
            'name' => ['required', 'unique:units,name'],

        ]);

        // Save the unit
        $unit = unit::create([
            'name' => $validatedData['name'],
            'description' => $request->unit_description,
            'abbreviation' => $request->abbreviation,

        ]);

        return redirect()->back()->with('success', 'Unit created successfully!');
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
        $unit = Unit::find($id);
        return view('unit.edit')->with('unit',$unit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          // Validate the incoming request data
          $validatedData = $request->validate([
            'name' => ['required', 'unique:units,name,' . $id], // Exclude current unit from unique check
        ]);

        // Find the units by ID
        $unit = Unit::findOrFail($id);



        // Update other units fields
        $unit->update([
            'name' => $validatedData['name'],
            'description' => $request->unit_description,
            'abbreviation' => $request->abbreviation,

        ]);

        return redirect()->back()->with('success', 'Unit updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit =Unit::find($id);

        if (!$unit) {
            return response()->json(['success' => false, 'message' => 'Unit not found.']);
        }


        $unit->delete();

        return response()->json(['success' => true, 'message' => 'Unit deleted successfully.']);
    }
}
