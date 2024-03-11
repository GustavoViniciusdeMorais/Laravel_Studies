<?php

namespace GustavoMorais\Article\Infrastructure\Observers;

use GustavoMorais\Article\Infrastructure\Repositories\ArticleEloquentRepository;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
    public function created(ArticleEloquentRepository $article)
    {
        Log::info("Article {$article->id} created");
    }
}
