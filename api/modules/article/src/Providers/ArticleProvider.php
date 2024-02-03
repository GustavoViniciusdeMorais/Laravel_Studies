<?php

namespace GustavoMorais\Article\Providers;

use Illuminate\Support\ServiceProvider;
use GustavoMorais\Article\Article;

class ArticleProvider extends ServiceProvider
{
    public function boot()
    {
        // code...
    }

    public function register()
    {
        $this->app->singleton('article', function($app){
            return new Article();
        });
    }
}
