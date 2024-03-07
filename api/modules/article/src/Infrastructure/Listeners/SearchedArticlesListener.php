<?php

namespace GustavoMorais\Article\Infrastructure\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use GustavoMorais\Article\Infrastructure\Events\SearchedArticlesEvent;
use Illuminate\Support\Facades\Log;
use GustavoMorais\Article\Infrastructure\Queue\Producer;

class SearchedArticlesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SearchedArticlesEvent  $event
     * @return void
     */
    public function handle(SearchedArticlesEvent $event)
    {
        $producer = new Producer();
        $producer->produce("test@email.com", "Article reader");
        Log::info('SearchedArticlesEvent');
        print_r(json_encode(['searched' => $event->data]));echo "\n\n";exit;
    }
}