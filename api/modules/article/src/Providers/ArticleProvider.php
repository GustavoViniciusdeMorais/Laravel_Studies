<?php

namespace GustavoMorais\Article\Providers;

use Illuminate\Support\ServiceProvider;
use GustavoMorais\Article\Article;
use Illuminate\Support\Facades\Event;
use GustavoMorais\Article\Infrastructure\Events\SearchedArticlesEvent;
use GustavoMorais\Article\Infrastructure\Listeners\SearchedArticlesListener;

class ArticleProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen(
            SearchedArticlesEvent::class,
            [SearchedArticlesListener::class, 'handle']
        );
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {
        $this->app->singleton('article', function($app){
            return new Article();
        });
    }
}
