<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FCMService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FCMService::class, function ($app) {
            return new FCMService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
