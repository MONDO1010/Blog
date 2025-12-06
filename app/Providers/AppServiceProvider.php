<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Http\ViewComposers\CartComposer;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Categories pour le header
        View::composer('layouts.header', function ($view) {
            $view->with('categories', Category::all());
        });

        // Cart count pour le header
        View::composer('layouts.header', CartComposer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
