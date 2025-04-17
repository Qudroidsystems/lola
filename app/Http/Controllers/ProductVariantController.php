<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariationValue;

use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $variants = ProductVariant::with(['product', 'variationValue.variation'])->get();
        return view('variant.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $products = Product::all();
        // $variationValues = VariationValue::with('variation')->get();
        return view('variant.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation_value_id' => 'required|exists:variation_values,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'required|unique:product_variants,sku',
        ]);

        ProductVariant::create($request->all());
        return redirect()->route('variants.index')->with('success', 'Variant created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
