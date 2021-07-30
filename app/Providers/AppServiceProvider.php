<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Station;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();
        /*
       * View Shares
       */
        $categories=Category::all();
        View::share('categories',$categories);

        $stations=Station::all();
        View::share('stations',$stations);
    }
}
