<?php

namespace App\Http\Controllers;

use Article;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function listArticles()
    {
        return new JsonResponse([
            Article::check()
        ], 200);
    }
}
