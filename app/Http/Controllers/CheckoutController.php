<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            Log::warning('Checkout accessed with empty cart for user: ' . auth()->id());
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        $shipping = $total > 500 ? 0 : 50;
        $total += $shipping;

        Log::info('Checkout loaded for user: ' . auth()->id() . ', Total: ' . $total);
        return view('frontend.checkout', compact('cartItems', 'total', 'shipping'));
    }

    public function createPaymentIntent(Request $request)
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            Log::warning('Payment intent requested with empty cart for user: ' . auth()->id());
            return response()->json(['error' => 'Cart is empty.'], 400);
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        $shipping = $total > 500 ? 0 : 50;
        $total += $shipping;

        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = PaymentIntent::create([
                'amount' => round($total * 100),
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'metadata' => ['user_id' => auth()->id()],
            ]);

            Log::info('Payment intent created for user: ' . auth()->id() . ', Intent ID: ' . $paymentIntent->id);
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            Log::error('Payment Intent Creation Failed for user: ' . auth()->id() . ', Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create payment intent.'], 500);
        }
    }

    public function processPayment(Request $request)
    {
        Log::info('Processing payment for user: ' . auth()->id() . ', Payment Intent: ' . $request->input('payment_intent'));

        $request->validate([
            'payment_intent' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $cartItems = auth()->user()->cartItems()->with('product')->get();
            if ($cartItems->isEmpty()) {
                Log::error('Cart is empty during payment processing for user: ' . auth()->id());
                throw new \Exception('Cart is empty.');
            }

            $total = $cartItems->sum(function ($item) {
                return $item->product->sale_price * $item->quantity;
            });

            $shipping = $total > 500 ? 0 : 50;
            $total += $shipping;

            Log::info('Calculated total for user: ' . auth()->id() . ', Total: ' . $total . ', Shipping: ' . $shipping);

            // Verify payment intent status
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent);
            if ($paymentIntent->status !== 'succeeded') {
                Log::error('Payment intent not succeeded for user: ' . auth()->id() . ', Status: ' . $paymentIntent->status);
                throw new \Exception('Payment not completed.');
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'shipping' => $shipping,
                'status' => 'completed',
                'payment_intent' => $request->payment_intent,
            ]);

            Log::info('Order created for user: ' . auth()->id() . ', Order ID: ' . $order->id);

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->sale_price,
                ]);
            }

            Log::info('Order items created for order: ' . $order->id);

            auth()->user()->cartItems()->delete();
            Log::info('Cart cleared for user: ' . auth()->id());

            DB::commit();
            Log::info('Transaction committed for order: ' . $order->id);

            return redirect()->route('order.success')
                             ->with('success', 'Payment successful! Your order has been placed.');
        } catch (\Stripe\Exception\ApiErrorException $e) {
            DB::rollBack();
            Log::error('Stripe API Error for user: ' . auth()->id() . ', Error: ' . $e->getMessage());
            return redirect()->route('cart.index')
                             ->with('error', 'Payment failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Processing Failed for user: ' . auth()->id() . ', Error: ' . $e->getMessage());
            return redirect()->route('cart.index')
                             ->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}
