<?php

namespace App\Providers;

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
        $this->app->bind('App\Interfaces\Stores\StoreServiceInterface', 'App\Services\StoreServiceMySql');
        $this->app->bind('App\Interfaces\Items\ItemServiceInterface', 'App\Services\ItemServiceMySql');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
