<?php

namespace GustavoMorais\Article\Providers;

use Illuminate\Events\EventServiceProvider as BaseEventServiceProvider;
use GustavoMorais\Article\Infrastructure\Events\SearchedArticlesEvent;
use GustavoMorais\Article\Infrastructure\Listeners\SearchedArticlesListener;

class EventServiceProvider extends BaseEventServiceProvider
{
    protected $listen = [
        SearchedArticlesEvent::class => [
            SearchedArticlesListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // parent::boot();
    }
}
