<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $is_octane = isset($_SERVER['LARAVEL_OCTANE']) && ((int)$_SERVER['LARAVEL_OCTANE'] === 1);
        if($is_octane)
            URL::forceScheme('https');
    }
}
