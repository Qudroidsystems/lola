<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Show checkout page (cart summary + simple form)
     */
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            Log::warning('Checkout accessed with empty cart for user: ' . auth()->id());
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return ($item->product->sale_price ?? $item->product->base_price ?? 0) * $item->quantity;
        });

        $shipping = $total > 500 ? 0 : 50;
        $total += $shipping;

        Log::info('Checkout loaded for user: ' . auth()->id() . ', Total: ' . $total);

        return view('frontend.checkout', compact('cartItems', 'total', 'shipping'));
    }

    /**
     * Process the checkout form (no payment intent / Stripe anymore)
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',           // added as example
            // Add more fields if needed (address, notes…)
        ]);

        Log::info('Manual checkout processing started for user: ' . auth()->id());

        DB::beginTransaction();

        try {
            $cartItems = auth()->user()->cartItems()->with('product')->get();

            if ($cartItems->isEmpty()) {
                Log::warning('Cart became empty during processing for user: ' . auth()->id());
                throw new \Exception('Cart is empty.');
            }

            $total = $cartItems->sum(function ($item) {
                return ($item->product->sale_price ?? $item->product->base_price ?? 0) * $item->quantity;
            });

            $shipping = $total > 500 ? 0 : 50;
            $total += $shipping;

            // Create the order (status = pending/manual)
            $order = Order::create([
                'user_id'      => auth()->id(),
                'total'        => $total,
                'shipping'     => $shipping,
                'status'       => 'pending',                    // ← important: not completed yet
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'notes'        => $request->notes ?? null,      // optional
                // payment_intent = null (no Stripe)
            ]);

            Log::info('Manual order created', ['order_id' => $order->id, 'user_id' => auth()->id()]);

            // Attach cart items to order
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->sale_price ?? $item->product->base_price ?? 0,
                ]);
            }

            // Clear the cart
            auth()->user()->cartItems()->delete();

            DB::commit();

            Log::info('Manual checkout completed successfully', ['order_id' => $order->id]);

            return redirect()->route('order.success')
                             ->with('success', 'Order placed successfully! Please chat with seller on WhatsApp to confirm payment & delivery.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Manual checkout failed', [
                'user_id' => auth()->id(),
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return redirect()->back()
                             ->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}
