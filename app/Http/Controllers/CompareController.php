<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ComparedProduct;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{

    public function add(Product $product)
    {
        try {
            // Get current compared products from session
            $comparedProducts = session()->get('compared_products', []);

            // Check if product already exists in comparison
            if (in_array($product->id, $comparedProducts)) {
                return redirect()->back()->with('error', 'Product is already in comparison list');
            }

            // Limit comparison to 4 products (adjust as needed)
            if (count($comparedProducts) >= 4) {
                return redirect()->back()->with('error', 'Maximum 4 products can be compared');
            }

            // Add product to comparison
            $comparedProducts[] = $product->id;
            session()->put('compared_products', $comparedProducts);

            // For authenticated users, store in database
            if (Auth::check()) {
                ComparedProduct::firstOrCreate([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id
                ]);
            }

            return redirect()->back()->with('success', 'Product added to comparison');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding to comparison: ' . $e->getMessage());
        }
    }

    // Add these additional methods for full functionality
    public function index()
    {
        $comparedIds = session()->get('compared_products', []);

        if (Auth::check()) {
            $comparedIds = ComparedProduct::where('user_id', Auth::id())
                ->pluck('product_id')
                ->toArray();

            session()->put('compared_products', $comparedIds);
        }

        $products = Product::with(['categories', 'brands', 'cover'])
            ->whereIn('id', $comparedIds)
            ->get();

        return view('compare.index', compact('products'));
    }

    public function remove(Product $product)
    {
        try {
            $comparedProducts = session()->get('compared_products', []);

            // Remove product from array
            $key = array_search($product->id, $comparedProducts);
            if ($key !== false) {
                unset($comparedProducts[$key]);
            }

            session()->put('compared_products', array_values($comparedProducts));

            // Remove from database if authenticated
            if (Auth::check()) {
                ComparedProduct::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->delete();
            }

            return redirect()->back()->with('success', 'Product removed from comparison');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error removing product: ' . $e->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
