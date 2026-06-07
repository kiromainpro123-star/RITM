<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS when app URL is configured with https or when running in production
        $appUrl = config('app.url');
        if ((is_string($appUrl) && str_starts_with($appUrl, 'https://')) || env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
