<?php

namespace App\Providers;

use App\Spot;
use App\Notification;
use App\Observers\SpotObserver;
use App\Observers\NotificationObserver;
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
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Spot::observe(SpotObserver::class);
        Notification::observe(NotificationObserver::class);
    }
}
