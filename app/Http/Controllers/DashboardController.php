<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:dashboard-list', ['only' => ['index','store']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * 
     * 
     */
  
     

    // public function index()
    // {
    //     if(auth()->user()->can('dashboard-list')){

    //       return view('dashboard');

    //     }
        
    //       return view('userdashboard');
    // }
        
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role;

        // Redirect non-admins to user dashboard
        if ($isAdmin != 'admin') {
            $orders = $user->orders()->latest()->get();
            $billingAddress = $user->billingAddress()->first();
            \Log::info('User dashboard accessed for user: ' . $user->id . ', Orders found: ' . $orders->count());
            return view('frontend.user-dashboard', compact('user', 'orders', 'billingAddress', 'isAdmin'));
        }

        // Admin dashboard data
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Expected Earnings (total order value this month)
        $expectedEarnings = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total');
        $previousMonthEarnings = Order::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->sum('total');
        $earningsChange = $previousMonthEarnings > 0
            ? (($expectedEarnings - $previousMonthEarnings) / $previousMonthEarnings) * 100
            : 0;

        // Orders This Month
        $ordersThisMonth = Order::whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
            ->count();
        $previousMonthOrders = Order::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();
        $ordersChange = $previousMonthOrders > 0
            ? (($ordersThisMonth - $previousMonthOrders) / $previousMonthOrders) * 100
            : 0;

        // Average Daily Sales
        $daysInMonth = Carbon::now()->daysInMonth;
        $avgDailySales = $daysInMonth > 0 ? $expectedEarnings / $daysInMonth : 0;
        $previousMonthAvgDailySales = $previousMonthEarnings / Carbon::now()->subMonth()->daysInMonth;
        $avgSalesChange = $previousMonthAvgDailySales > 0
            ? (($avgDailySales - $previousMonthAvgDailySales) / $previousMonthAvgDailySales) * 100
            : 0;

        // New Customers This Month
        $newCustomersCount = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();
        $recentCustomers = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->take(6)
            ->get();

        // Sales by Category
        $categorySales = Order::whereBetween('orders.created_at', [$startOfMonth, $endOfMonth])
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('product_category', 'products.id', '=', 'product_category.product_id')
            ->join('categories', 'product_category.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category_name, SUM(order_items.price * order_items.quantity) as total')
            ->groupBy('categories.name')
            ->pluck('total', 'category_name')
            ->toArray();

        // Product Orders
        $productOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($order) {
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
                    'items' => $order->items->map(function ($item) {
                        return [
                            'name' => $item->product->name,
                            'description' => $item->product->description ?? 'No description',
                            'image' => $item->product->thumbnail ?? '/metronic8/demo1/assets/media/stock/ecommerce/1.png',
                            'cost' => $item->product->base_price ?? 0,
                            'quantity' => $item->quantity,
                            'total' => $item->price * $item->quantity,
                            'stock' => $item->product->stock ?? 0,
                        ];
                    }),
                ];
            });

        \Log::info('Admin dashboard accessed for user: ' . $user->id . ', Is Admin: Yes, Orders This Month: ' . $ordersThisMonth);
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
            'productOrders'
        ));
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
        //
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
