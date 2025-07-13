<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Log authentication status
        Log::info('Cart Index: User ID = ' . (auth()->check() ? auth()->id() : 'Not authenticated'));
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        return view('frontend.cart', compact('cartItems', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        try {
            // Explicitly set user_id in updateOrCreate
            $cartItem = auth()->user()->cartItems()->updateOrCreate(
                ['product_id' => $request->product_id, 'user_id' => auth()->id()],
                ['quantity' => \DB::raw('quantity + ' . ($request->quantity ?? 1))]
            );

            Log::info('Cart Item Stored: User ID = ' . auth()->id() . ', Product ID = ' . $request->product_id . ', CartItem ID = ' . $cartItem->id);

            return redirect()->back()->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            Log::error('Cart Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error adding to cart: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cartItem = CartItem::findOrFail($id);

        // Log user and cart item details for debugging
        Log::info('Update Attempt: User ID = ' . (auth()->check() ? auth()->id() : 'Not authenticated') . ', CartItem User ID = ' . $cartItem->user_id . ', CartItem ID = ' . $id);

        $this->authorize('update', $cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $cartItem->update(['quantity' => $request->quantity]);
            return redirect()->route('cart.index')->with('success', 'Cart updated!');
        } catch (\Exception $e) {
            Log::error('Cart Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating cart: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = CartItem::findOrFail($id);

        // Log for debugging
        Log::info('Delete Attempt: User ID = ' . (auth()->check() ? auth()->id() : 'Not authenticated') . ', CartItem User ID = ' . $cartItem->user_id . ', CartItem ID = ' . $id);

        $this->authorize('delete', $cartItem);

        try {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        } catch (\Exception $e) {
            Log::error('Cart Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting item: ' . $e->getMessage());
        }
    }

    /**
     * Redirect to checkout.
     */
    public function checkout()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        // Add shipping if applicable
        $shipping = $total > 500 ? 0 : 50;
        $total += $shipping;

        return view('frontend.checkout', compact('cartItems', 'total', 'shipping'));
    }
}