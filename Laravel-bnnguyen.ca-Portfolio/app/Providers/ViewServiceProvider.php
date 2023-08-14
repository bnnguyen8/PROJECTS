<?php

namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

// https://laravel.com/docs/10.x/views#view-composers
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('cart', CartComposer::class);
        View::composer('footer', MenuComposer::class); // cart is cart.blade.php
        // View::composer('*', 'App\Http\ViewComposers\ProductNewsComposer'); //  nếu khai báo như vậy thì view nào cũng có thể sử dụng pramter này.
    }
}
