<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;


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
        View::composer('frontend.*', function ($view) {
            $view->with('mainCategories', ProductCategory::whereNull('parent_id')->with('children.children')->orderBy('sequence')->get());
        });
    }
}

