<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        \Carbon\Carbon::setLocale('id');
        Paginator::useBootstrap();
        foreach (glob(app_path('Helpers/*.php')) as $filename) {
            require_once $filename;
        }
    }
}
