<?php

namespace Redninjaturtle\RedLaravelLocation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Redninjaturtle\RedLaravelLocation\Location;

class LocationServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Route::middleware(['web'])
            ->group(__DIR__ . '/../Routes/web.php');
        
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'Location');

        Route::namespace('Redninjaturtle\RedLaravelLocation\Http\Controllers')
            ->middleware(['web'])
            ->group(__DIR__ . '/../Routes/web.php');
        
        $this->loadViewsFrom(__DIR__ . '/../Views', 'Location');

        $this->publishes([
            __DIR__ . '/../database/seeders/LocationsSeeder.php' =>
            resource_path('database/vendor/seeders/LocationsSeeder.php')
        ], 'seeders');

        $this->publishes([
            __DIR__ . '/../config/locations.php' => config_path('locations.php')
        ], 'config-locations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/locations.php',
            'config-locations'
        );

        $this->app->singleton('location', function($app){
            return new Location('pt-br');
        });
    }
}

