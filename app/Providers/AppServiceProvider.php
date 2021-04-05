<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
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
        if (config('app.env') == 'production') {
            URL::forceScheme('https');
        }
        
        View::composer('*', function($view) {
            $categories = Schema::hasTable('categories') ? Category::orderBy('name', 'asc')->get() : null;
            $cart = session('cart') ? session('cart') : null;
            $view->with(['cart' => $cart, 'categories' => $categories]);
        });
    }
}
