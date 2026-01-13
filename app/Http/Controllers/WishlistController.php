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

    auth()->user()->wishlistItems()->firstOrCreate([
        'user_id' => auth()->id(),          // ← Add this line if missing
        'product_id' => $request->product_id
    ]);

    return redirect()->back()->with('success', 'Added to wishlist!');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $wishlistItem = WishlistItem::findOrFail($id);

    // Debug - remove this after testing
    \Log::info('Wishlist destroy attempt', [
        'item_id' => $id,
        'item_user_id' => $wishlistItem->user_id,
        'current_user_id' => auth()->id(),
        'is_owner' => $wishlistItem->user_id === auth()->id(),
    ]);

    if ($wishlistItem->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    $wishlistItem->delete();

    return redirect()->back()->with('success', 'Removed from wishlist');
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
