<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlistItems = auth()->user()->wishlistItems()->with('product')->get();
        return view('frontend.wishlist', compact('wishlistItems'));
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
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        try {
            auth()->user()->wishlistItems()->firstOrCreate([
                'product_id' => $request->product_id
            ]);

            return redirect()->back()->with('success', 'Added to wishlist!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding to wishlist: ' . $e->getMessage());
        }
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
        $this->authorize('delete', $wishlistItem);

        try {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Removed from wishlist');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error removing item: ' . $e->getMessage());
        }
    }
    
}
