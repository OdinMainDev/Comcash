<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::defaultView('pagination.'.env("THEME_PAGINATION_NAME", "comcash"));
        $is_octane = isset($_SERVER['LARAVEL_OCTANE']) && ((int)$_SERVER['LARAVEL_OCTANE'] === 1);
        if($is_octane){
            URL::forceScheme('https');
            app()->rebinding('translator', function ($app, $instance) {
                app()->instance('translator', null);
            });
            app()->rebinding('translation.loader', function ($app, $instance) {
                app()->instance('translation.loader', null);
            });
        }
    }
}
