<?php

namespace GustavoMorais\Article\Providers;

use Illuminate\Support\ServiceProvider;
use GustavoMorais\Article\Article;

class ArticleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {
        $this->app->singleton('article', function($app){
            return new Article();
        });
    }
}
