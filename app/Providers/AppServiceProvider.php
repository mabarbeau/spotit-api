<?php

namespace App\Providers;

use App\Observers\SpotObserver;
use App\Spot;
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
        Spot::observe(SpotObserver::class);
    }
}
