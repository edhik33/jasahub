<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $cartCount = Cart::where('user_id', $userId)->sum('quantity');
                $view->with('cartCount', $cartCount);
            } else {
                $view->with('cartCount', 0);
            }
        });
    }
}
