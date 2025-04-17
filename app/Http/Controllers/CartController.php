<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        return view('frontend.cart', compact('cartItems', 'total'));
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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        try {
            $cartItem = auth()->user()->cartItems()->updateOrCreate(
                ['product_id' => $request->product_id],
                ['quantity' => \DB::raw('quantity + ' . ($request->quantity ?? 1))]
            );

            return redirect()->back()->with('success', 'Product added to cart!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding to cart: ' . $e->getMessage());
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
        // Retrieve the cart item first
        $cartItem = CartItem::findOrFail($id);

        // Now we can authorize and use it
        $this->authorize('update', $cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $cartItem->update(['quantity' => $request->quantity]);
            return redirect()->route('cart.index')->with('success', 'Cart updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating cart: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Retrieve the cart item first
        $cartItem = CartItem::findOrFail($id);

        // 2. Then authorize the action
        $this->authorize('delete', $cartItem);

        // 3. Proceed with deletion
        try {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        } catch (\Exception $e) {
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
