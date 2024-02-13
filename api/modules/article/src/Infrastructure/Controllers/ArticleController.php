<?php

namespace GustavoMorais\Article\Infrastructure\Controllers;

use GustavoMorais\Article\Application\Queries\GetArticlesAction;
use GustavoMorais\Article\Infrastructure\Controllers\BaseController;

class ArticleController extends BaseController
{
    public function listArticles()
    {
        try {
            $articles = (new GetArticlesAction())->execute();
            return $this->success($articles);
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
