<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            Log::info('Cart Index: No authenticated user');
            return redirect()->route('login')->with('error', 'Please log in to view cart.');
        }
        Log::info('Cart Index: User ID = ' . auth()->id() . ', Email = ' . auth()->user()->email);
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

        if (!auth()->check()) {
            Log::error('Cart Store: No authenticated user');
            return redirect()->route('login')->with('error', 'Please log in to add items to cart.');
        }

        try {
            $cartItem = auth()->user()->cartItems()->updateOrCreate(
                ['product_id' => $request->product_id, 'user_id' => auth()->id()],
                ['quantity' => DB::raw('quantity + ' . ($request->quantity ?? 1))]
            );

            Log::info('Cart Item Stored: User ID = ' . auth()->id() . ', Product ID = ' . $request->product_id . ', CartItem ID = ' . $cartItem->id);

            return redirect()->back()->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'SQLSTATE[HY000]: General error: 1615') !== false) {
                Log::warning('SQL 1615 Error in store, retrying...');
                try {
                    $cartItem = auth()->user()->cartItems()->updateOrCreate(
                        ['product_id' => $request->product_id, 'user_id' => auth()->id()],
                        ['quantity' => DB::raw('quantity + ' . ($request->quantity ?? 1))]
                    );
                    return redirect()->back()->with('success', 'Product added to cart!');
                } catch (\Exception $e2) {
                    Log::error('Cart Store Retry Error: ' . $e2->getMessage());
                    return redirect()->back()->with('error', 'Error adding to cart: ' . $e2->getMessage());
                }
            }
            Log::error('Cart Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error adding to cart: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->check()) {
            Log::error('Cart Update: No authenticated user');
            return redirect()->route('login')->with('error', 'Please log in to update cart.');
        }

        $cartItem = CartItem::findOrFail($id);

        Log::info('Update Attempt: User ID = ' . auth()->id() . ', Email = ' . auth()->user()->email . ', CartItem User ID = ' . $cartItem->user_id . ', CartItem ID = ' . $id);

        $this->authorize('update', $cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $cartItem->update(['quantity' => $request->quantity]);
            return redirect()->route('cart.index')->with('success', 'Cart updated!');
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'SQLSTATE[HY000]: General error: 1615') !== false) {
                Log::warning('SQL 1615 Error in update, retrying...');
                try {
                    $cartItem->update(['quantity' => $request->quantity]);
                    return redirect()->route('cart.index')->with('success', 'Cart updated!');
                } catch (\Exception $e2) {
                    Log::error('Cart Update Retry Error: ' . $e2->getMessage());
                    return redirect()->back()->with('error', 'Error updating cart: ' . $e2->getMessage());
                }
            }
            Log::error('Cart Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating cart: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->check()) {
            Log::error('Cart Destroy: No authenticated user');
            return redirect()->route('login')->with('error', 'Please log in to remove items from cart.');
        }

        $cartItem = CartItem::findOrFail($id);

        Log::info('Delete Attempt: User ID = ' . auth()->id() . ', Email = ' . auth()->user()->email . ', CartItem User ID = ' . $cartItem->user_id . ', CartItem ID = ' . $id);

        $this->authorize('delete', $cartItem);

        try {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'SQLSTATE[HY000]: General error: 1615') !== false) {
                Log::warning('SQL 1615 Error in destroy, retrying...');
                try {
                    $cartItem->delete();
                    return redirect()->route('cart.index')->with('success', 'Item removed from cart');
                } catch (\Exception $e2) {
                    Log::error('Cart Delete Retry Error: ' . $e2->getMessage());
                    return redirect()->back()->with('error', 'Error deleting item: ' . $e2->getMessage());
                }
            }
            Log::error('Cart Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting item: ' . $e->getMessage());
        }
    }

    /**
     * Redirect to checkout.
     */
    public function checkout()
    {
        if (!auth()->check()) {
            Log::error('Cart Checkout: No authenticated user');
            return redirect()->route('login')->with('error', 'Please log in to proceed to checkout.');
        }

        $cartItems = auth()->user()->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        $shipping = $total > 500 ? 0 : 50;
        $total += $shipping;

        return view('frontend.checkout', compact('cartItems', 'total', 'shipping'));
    }
}