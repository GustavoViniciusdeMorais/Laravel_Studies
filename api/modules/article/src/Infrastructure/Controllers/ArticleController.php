<?php

namespace GustavoMorais\Article\Infrastructure\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class ArticleController extends BaseController
{
    public function listArticles()
    {
        return new JsonResponse([
            'ok'
        ], 200);
    }
}
