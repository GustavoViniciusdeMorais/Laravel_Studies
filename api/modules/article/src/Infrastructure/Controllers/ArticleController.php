<?php

namespace GustavoMorais\Article\Infrastructure\Controllers;

use GustavoMorais\Article\Application\Queries\GetArticlesAction;
use GustavoMorais\Article\Application\Commands\CreateArticleAction;
use GustavoMorais\Article\Infrastructure\Controllers\BaseController;
use Illuminate\Http\Request;

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

    public function createArticle(Request $request)
    {
        try {
            return $this->success((new CreateArticleAction())->setData($request->all())->execute());
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
