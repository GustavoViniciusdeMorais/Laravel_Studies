<?php

namespace GustavoMorais\Sale\Providers;

use Illuminate\Support\ServiceProvider;

class SaleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {
        // register singleton if needed
    }
}
