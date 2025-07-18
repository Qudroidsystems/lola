<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dashboard-list', ['only' => ['index', 'store']]);
    }


    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->hasRole('Admin'); // Support both Spatie and role column
        Log::info('Dashboard accessed - User ID: ' . $user->id . ', Roles: ' . json_encode($user->getRoleNames()) . ', Table Role: ' . $user->role . ', Is Admin: ' . ($isAdmin ? 'Yes' : 'No'));

        // Redirect non-admins to user dashboard
        if (!$isAdmin) {
            $orders = $user->orders()->latest()->get();
            $billingAddress = $user->billingAddress()->first();
            Log::info('User dashboard accessed for user: ' . $user->id . ', Orders found: ' . $orders->count());
            return view('frontend.user-dashboard', compact('user', 'orders', 'billingAddress', 'isAdmin'));
        }

        // Admin dashboard data
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        try {
            $expectedEarnings = Cache::remember('expected_earnings_' . $startOfMonth->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total');
            });
            $previousMonthEarnings = Cache::remember('prev_earnings_' . $startOfMonth->subMonth()->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return Order::whereBetween('created_at', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth()
                ])->sum('total');
            });
            $earningsChange = $previousMonthEarnings > 0
                ? (($expectedEarnings - $previousMonthEarnings) / $previousMonthEarnings) * 100
                : 0;

            $ordersThisMonth = Cache::remember('orders_this_month_' . $startOfMonth->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            });
            $previousMonthOrders = Cache::remember('prev_orders_' . $startOfMonth->subMonth()->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return Order::whereBetween('created_at', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth()
                ])->count();
            });
            $ordersChange = $previousMonthOrders > 0
                ? (($ordersThisMonth - $previousMonthOrders) / $previousMonthOrders) * 100
                : 0;

            $daysInMonth = Carbon::now()->daysInMonth;
            $avgDailySales = $daysInMonth > 0 ? $expectedEarnings / $daysInMonth : 0;
            $previousMonthAvgDailySales = $previousMonthEarnings / Carbon::now()->subMonth()->daysInMonth;
            $avgSalesChange = $previousMonthAvgDailySales > 0
                ? (($avgDailySales - $previousMonthAvgDailySales) / $previousMonthAvgDailySales) * 100
                : 0;

            $newCustomersCount = Cache::remember('new_customers_' . $startOfMonth->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            });
            $recentCustomers = Cache::remember('recent_customers_' . $startOfMonth->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->take(6)->get();
            });

            $categorySales = Cache::remember('category_sales_' . $startOfMonth->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return Order::whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('product_category', 'products.id', '=', 'product_category.product_id')
                    ->join('categories', 'product_category.category_id', '=', 'categories.id')
                    ->selectRaw('categories.name as category_name, SUM(order_items.price * order_items.quantity) as total')
                    ->groupBy('categories.name')
                    ->pluck('total', 'category_name')
                    ->toArray();
            });

            $dailySales = Cache::remember('daily_sales_' . $startOfMonth->format('Y-m'), 60, function () use ($startOfMonth, $endOfMonth) {
                return Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                    ->selectRaw('DATE(created_at) as date, SUM(total) as total')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->pluck('total', 'date')
                    ->toArray();
            });

            $productOrders = Order::with(['user', 'items.product'])
                ->latest()
                ->paginate(10)
                ->through(function ($order) {
                    $cartItems = Cache::remember('cart_items_user_' . $order->user_id, 60, function () use ($order) {
                        return CartItem::where('user_id', $order->user_id)
                            ->with('product')
                            ->get()
                            ->map(function ($item) {
                                return [
                                    'name' => $item->product->name,
                                    'description' => $item->product->description ?? 'No description',
                                    'image' => $item->product->thumbnail ?? '/metronic8/demo1/assets/media/stock/ecommerce/1.png',
                                    'cost' => $item->product->base_price ?? 0,
                                    'quantity' => $item->quantity,
                                    'total' => ($item->product->base_price ?? 0) * $item->quantity,
                                    'stock' => $item->product->stock ?? 0,
                                ];
                            });
                    });

                    $profit = $order->items->sum(function ($item) {
                        return ($item->price - ($item->product->base_price ?? 0)) * $item->quantity;
                    });

                    return [
                        'id' => $order->id,
                        'created_at' => $order->created_at->diffForHumans(),
                        'customer' => $order->user->name,
                        'total' => $order->total,
                        'profit' => $profit,
                        'status' => $order->status,
                        'items' => $cartItems,
                    ];
                });

            Log::info('Admin dashboard accessed for user: ' . $user->id . ', Is Admin: Yes, Orders This Month: ' . $ordersThisMonth);
            return view('dashboard', compact(
                'user',
                'isAdmin',
                'expectedEarnings',
                'earningsChange',
                'ordersThisMonth',
                'ordersChange',
                'avgDailySales',
                'avgSalesChange',
                'newCustomersCount',
                'recentCustomers',
                'categorySales',
                'dailySales',
                'productOrders'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching dashboard data: ' . $e->getMessage());
            return view('dashboard', [
                'user' => $user,
                'isAdmin' => $isAdmin,
                'expectedEarnings' => 0,
                'earningsChange' => 0,
                'ordersThisMonth' => 0,
                'ordersChange' => 0,
                'avgDailySales' => 0,
                'avgSalesChange' => 0,
                'newCustomersCount' => 0,
                'recentCustomers' => collect([]),
                'categorySales' => [],
                'dailySales' => [],
                'productOrders' => collect([])->paginate(10)
            ])->with('error', 'Failed to load dashboard data. Please try again later.');
        }
    }

    
    public function create() { /* ... */ }
    public function store(Request $request) { /* ... */ }
    public function show(string $id) { /* ... */ }
    public function edit(string $id) { /* ... */ }
    public function update(Request $request, string $id) { /* ... */ }
    public function destroy(string $id) { /* ... */ }
}