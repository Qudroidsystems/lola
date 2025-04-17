<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with(['order', 'customer'])->get();
        return response()->json($payments);
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
                // Validate the request
            $validated = $request->validate([
                'items' => 'required|array|min:1', // Ensure at least one item is sent
                'items.*.product_id' => 'required|integer|exists:products,id', // Validate each product
                'items.*.quantity' => 'required|integer|min:1', // Ensure valid quantities
                'payment_method' => 'required|string|in:cash,card,transfer', // Validate payment method
            ]);

            // Generate a unique Order ID
            $orderId = (string) Str::uuid();

            // Process order and save to the database
            $order = Order::create([
                'order_id' => $orderId,
                'customer_id' => $request->customer_id ?? null, // Optional, depending on your setup
                'total_amount' => $this->calculateTotalAmount($validated['items']),
                'status' => 'Pending',
            ]);

            // Save order items
            foreach ($validated['items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
    }

            // Send the response with the generated Order ID
            return response()->json([
                'message' => 'Order created successfully.',
                'order_id' => $orderId,
            ], 201);
}

    private function calculateTotalAmount($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $total += $product->price * $item['quantity'];
        }
        return $total;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with(['order', 'customer'])->findOrFail($id);
        return response()->json($payment);
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
        //
    }
}
