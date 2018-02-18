<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Centaur\Middleware\SentinelGuest', function ($app) {
            return new \App\Http\Middleware\SentinelGuest;
        });
        $this->app->bind('Centaur\Middleware\SentinelAuthenticate', function ($app) {
            return new \App\Http\Middleware\SentinelAuthenticate;
        });
        $this->app->bind('Unisharp\Laravelfilemanager\Handlers\ConfigHandler', function ($app) {
            return new \App\Handlers\ConfigHandler;
        });
    }
}
