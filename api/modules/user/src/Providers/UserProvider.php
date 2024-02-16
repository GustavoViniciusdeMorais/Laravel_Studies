<?php

namespace GustavoMorais\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
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
