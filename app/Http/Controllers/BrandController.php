<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brand.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('brand.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => ['required', 'unique:brands,name'],
            'meta_brand_description' => ['required'],
            'slug' => ['required'],

        ]);

        // Save the brand
        $brand = Brand::create([
            'name' => $validatedData['name'],
            'description' => $request->meta_brand_description,
            'slug' => $request->slug,

        ]);

        return redirect()->back()->with('success', 'Brand created successfully!');
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
        $brand = Brand::find($id);
        return view('brand.edit')->with('brand',$brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
               // Validate the incoming request data
               $validatedData = $request->validate([
                'name' => ['required', 'unique:brands,name,' . $id], // Exclude current brand from unique check
            ]);

            // Find the Brands by ID
            $brand = Brand::findOrFail($id);



            // Update other Brands fields
            $brand->update([
                'name' => $validatedData['name'],
                'description' => $request->brand_description,
                'slug' => $request->slug,

            ]);

            return redirect()->back()->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand =Brand::find($id);

        if (!$brand) {
            return response()->json(['success' => false, 'message' => 'brand not found.']);
        }


        $brand->delete();

        return response()->json(['success' => true, 'message' => 'brand deleted successfully.']);
    }
}
