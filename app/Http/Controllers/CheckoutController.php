<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            return ($item->product->sale_price ?? $item->product->base_price ?? 0) * $item->quantity;
        });

        $shipping = $total > 500 ? 0 : 50;
        $total += $shipping;

        Log::info('Checkout loaded for user: ' . auth()->id() . ', Total: ' . $total);

        return view('frontend.checkout', compact('cartItems', 'total', 'shipping'));
    }

    /**
     * Process checkout and redirect to WhatsApp for confirmation
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            // Add more fields if needed (address, notes…)
        ]);

        Log::info('Manual checkout processing started for user: ' . auth()->id());

        DB::beginTransaction();

        try {
            $cartItems = auth()->user()->cartItems()->with('product')->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty.');
            }

            $total = $cartItems->sum(function ($item) {
                return ($item->product->sale_price ?? $item->product->base_price ?? 0) * $item->quantity;
            });

            $shipping = $total > 500 ? 0 : 50;
            $total += $shipping;

            // Create order (pending status)
            $order = Order::create([
                'user_id'  => auth()->id(),
                'total'    => $total,
                'shipping' => $shipping,
                'status'   => 'pending',
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'notes'    => $request->notes ?? null,
            ]);

            // Attach items
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->sale_price ?? $item->product->base_price ?? 0,
                ]);
            }

            // Clear cart
            auth()->user()->cartItems()->delete();

            DB::commit();

            Log::info('Manual order placed successfully', ['order_id' => $order->id]);

            // Prepare WhatsApp message
            $message = "Hello! 👋\nNew order just placed!\n\nOrder ID: #{$order->id}\nCustomer: {$request->name}\nPhone: {$request->phone}\nEmail: {$request->email}\n\nItems:\n";

            foreach ($cartItems as $item) {
                $price = $item->product->sale_price ?? $item->product->base_price ?? 0;
                $message .= "• {$item->product->name} × {$item->quantity} = RM " . number_format($price * $item->quantity, 2) . "\n";
            }

            $message .= "\nSubtotal: RM " . number_format($total - $shipping, 2);
            $message .= "\nShipping: RM " . number_format($shipping, 2);
            $message .= "\n─────────────────";
            $message .= "\n*Total: RM " . number_format($total, 2) . "*";
            $message .= "\n\nPlease confirm stock, payment method & delivery. Thank you!";

            $phone = '601136655467'; // Seller phone
            $encoded = urlencode($message);
            $whatsappUrl = "https://wa.me/{$phone}?text={$encoded}";

            // Redirect to success page with WhatsApp URL
            return redirect()->route('order.success')
                             ->with('success', 'Order placed successfully! Redirecting to WhatsApp...')
                             ->with('whatsapp_url', $whatsappUrl);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout failed', [
                'user_id' => auth()->id(),
                'error'   => $e->getMessage()
            ]);

            return redirect()->back()
                             ->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}
