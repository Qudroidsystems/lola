<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

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
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        View::composer('frontend.master', function ($view) {
            $cartCount = 0;
            $cartItems = collect();
            $cartTotal = 0;

            if (auth()->check()) {
                Log::info('View Composer: User ID = ' . auth()->id());
                try {
                    $cartItems = auth()->user()->cartItems()->with('product')->get();
                    $cartCount = $cartItems->sum('quantity');
                    $cartTotal = $cartItems->sum(function ($item) {
                        return $item->quantity * $item->product->sale_price;
                    });
                } catch (\Exception $e) {
                    Log::error('View Composer Error: ' . $e->getMessage());
                }
            } else {
                Log::info('View Composer: No authenticated user');
            }

            $view->with([
                'cartCount' => $cartCount,
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal
            ]);
        });
    }
}