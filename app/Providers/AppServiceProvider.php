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
        //dd(app('weather.sources')->yandex);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('display', function($app){
            return new Display;
        });
    }
}
