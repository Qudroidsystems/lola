<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
                $products = Product::with(['tags', 'brands'])
                    ->when($request->search, function($query) use ($request) {
                        $query->where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('description', 'like', '%'.$request->search.'%');
                    })
                    ->when($request->category, function($query) use ($request) {
                        $query->whereHas('categories', function($q) use ($request) {
                            $q->where('slug', $request->category);
                        });
                    })
                    ->when($request->brand, function($query) use ($request) {
                        $query->whereHas('brands', function($q) use ($request) {
                            $q->where('slug', $request->brand);
                        });
                    })
                    ->when($request->price, function($query) use ($request) {
                        $price = explode('-', $request->price);
                        $query->whereBetween('base_price', [$price[0], $price[1]]);
                    })
                    ->when($request->sort, function($query) use ($request) {
                        switch ($request->sort) {
                            case 'name_asc':
                                $query->orderBy('name', 'asc');
                                break;
                            case 'name_desc':
                                $query->orderBy('name', 'desc');
                                break;
                            case 'price_asc':
                                $query->orderBy('base_price', 'asc');
                                break;
                            case 'price_desc':
                                $query->orderBy('base_price', 'desc');
                                break;
                            default:
                                $query->latest();
                        }
                    }, function($query) {
                        $query->latest();
                    })
                    ->paginate(12);

                // Get filter data for sidebar
                $categories = Category::withCount('products')->get();
                $brands = Brand::withCount('products')->get();

                return view('frontend.shop', compact('products', 'categories', 'brands'));
     }

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
            // Find the product by ID and load related data
            $product = Product::with(['categories', 'brands', 'units', 'warehouses', 'images', 'reviews.user'])
            ->findOrFail($id);

            // Return the product details view
            return view('frontend.singleProduct', compact('product'));
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
