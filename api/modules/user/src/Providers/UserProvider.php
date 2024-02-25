<?php

namespace GustavoMorais\User\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use GustavoMorais\User\Infrastructure\Middlewares\AuthMiddleware;

class UserProvider extends ServiceProvider
{
    public function boot()
    {
        
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('authMiddleware', AuthMiddleware::class);
        
    }

    public function register()
    {
        // register singleton if needed
    }
}
