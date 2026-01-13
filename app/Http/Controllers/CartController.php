<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        if (!auth()->check()) {
            Log::info('Cart Index: No authenticated user');
            return redirect()->route('login')->with('error', 'Please log in to view your cart.');
        }

        Log::info('Cart Index accessed', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->email
        ]);

        $cartItems = auth()->user()->cartItems()->with('product')->get();

        $total = $cartItems->sum(function ($item) {
            return ($item->product->sale_price ?? $item->product->base_price) * $item->quantity;
        });

        return view('frontend.cart', compact('cartItems', 'total'));
    }

    /**
     * Add a product to the cart (AJAX support).
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to add items to cart.'
            ], 401);
        }

        try {
            $quantity = $request->quantity ?? 1;

            $cartItem = auth()->user()->cartItems()->updateOrCreate(
                ['product_id' => $request->product_id],
                ['quantity' => DB::raw("quantity + {$quantity}")]
            );

            Log::info('Product added to cart', [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email,
                'product_id' => $request->product_id,
                'quantity_added' => $quantity,
                'new_total_quantity' => $cartItem->quantity
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => auth()->user()->cartItems()->count(), // For header update
                'cart_item' => $cartItem->load('product') // Optional: full item data
            ]);
        } catch (\Exception $e) {
            Log::error('Cart store failed', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to add to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity (AJAX support).
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to update your cart.'
            ], 401);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($id);

        // Security: Only allow owner to update
        if ($cartItem->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'.$cartItem->user_id
            ], 403);
        }

        try {
            $cartItem->update(['quantity' => $request->quantity]);

            Log::info('Cart item updated', [
                'cart_item_id' => $id,
                'user_id' => auth()->id(),
                'new_quantity' => $request->quantity
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'cart_count' => auth()->user()->cartItems()->count()
            ]);
        } catch (\Exception $e) {
            Log::error('Cart update failed', [
                'cart_item_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove a specific item from the cart (AJAX support).
     */
    public function destroy(string $id)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to remove items from cart.'
            ], 401);
        }

        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'.$cartItem->user_id.' '. auth()->id()
            ], 403);
        }

        try {
            $cartItem->delete();

            Log::info('Cart item removed', [
                'cart_item_id' => $id,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart!',
                'cart_count' => auth()->user()->cartItems()->count()
            ]);
        } catch (\Exception $e) {
            Log::error('Cart destroy failed', [
                'cart_item_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Redirect to checkout (non-AJAX).
     */
    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to proceed to checkout.');
        }

        $cartItems = auth()->user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return ($item->product->sale_price ?? $item->product->base_price) * $item->quantity;
        });

        $shipping = $total > 500 ? 0 : 50;
        $total += $shipping;

        return view('frontend.checkout', compact('cartItems', 'total', 'shipping'));
    }

    public function clear()
{
    auth()->user()->cartItems()->delete();
    return response()->json(['success' => true, 'message' => 'Cart cleared!']);
}
}
