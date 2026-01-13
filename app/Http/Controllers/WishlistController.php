<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishlistItem;

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wishlistItem = WishlistItem::findOrFail($id);

        // Optional: Check if the item belongs to the user
        if ($wishlistItem->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Authorization (uncomment if policy exists)
        // $this->authorize('delete', $wishlistItem);

        try {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Removed from wishlist');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error removing item: ' . $e->getMessage());
        }
    }


    /**
 * Clear all wishlist items for the authenticated user
 */
public function clearAll()
{
    auth()->user()->wishlistItems()->delete();

    return redirect()->route('wishlist.index')
        ->with('success', 'Your wishlist has been cleared!');
}
}
