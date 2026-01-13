<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class OrderController extends Controller
{
    /**
     * Display a listing of customer orders with filters
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product'])->latest();

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by customer name or email
        if ($request->filled('customer')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($user) use ($request) {
                    $user->where('name', 'like', '%' . $request->customer . '%')
                         ->orWhere('email', 'like', '%' . $request->customer . '%');
                })
                ->orWhere('name', 'like', '%' . $request->customer . '%')
                ->orWhere('email', 'like', '%' . $request->customer . '%');
            });
        }

        $orders = $query->paginate(15)->appends($request->query());

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the details of a specific order
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        return view('orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,failed'
        ]);

        $order->update(['status' => $request->status]);

        Log::info('Order status updated', [
            'order_id' => $order->id,
            'new_status' => $request->status,
            'admin_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Export filtered orders to Excel
     */
    public function export(Request $request)
    {
        $query = Order::with(['user', 'items.product'])->latest();

        // Apply same filters
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('customer')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($user) use ($request) {
                    $user->where('name', 'like', '%' . $request->customer . '%')
                         ->orWhere('email', 'like', '%' . $request->customer . '%');
                })
                ->orWhere('name', 'like', '%' . $request->customer . '%')
                ->orWhere('email', 'like', '%' . $request->customer . '%');
            });
        }

        $orders = $query->get();

        return Excel::download(new OrdersExport($orders), 'orders-' . now()->format('Y-m-d') . '.xlsx');
    }
}
