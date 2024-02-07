<?php

namespace GustavoMorais\Article\Facades;

use Illuminate\Support\Facades\Facade;

class ArticleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'article';
    }
}
