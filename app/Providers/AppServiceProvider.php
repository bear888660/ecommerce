<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Management;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        view()->composer('admin.layout.includes.sidenav', function($view){
            $view->with('nav_managements', Management::orderBy('index_id', 'asc')->get());
        });
    }
}
