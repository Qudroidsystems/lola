<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Add this line

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // In boot() method
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        
        View::composer('frontend.master', function ($view) {
            $cartCount = 0;
            $cartItems = collect();
            $cartTotal = 0;

            if (auth()->check()) {
                $cartItems = auth()->user()->cartItems()->with('product')->get();
                $cartCount = $cartItems->sum('quantity');
                $cartTotal = $cartItems->sum(function ($item) {
                    return $item->quantity * $item->product->sale_price;
                });
            }

            $view->with([
                'cartCount' => $cartCount,
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal
            ]);
        });

    }
}
