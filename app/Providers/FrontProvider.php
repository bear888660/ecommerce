<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductCategory;
class FrontProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        view()->composer('front.layouts.front', function($view){
            $view->with('nav_product_categories', ProductCategory::orderBy('index_id', 'asc')->get());
        });
    }
}
