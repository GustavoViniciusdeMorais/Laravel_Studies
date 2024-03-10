<?php

namespace GustavoMorais\Article\Infrastructure\Events;

use Illuminate\Queue\SerializesModels;

class SearchedArticlesEvent
{
    use SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
}
