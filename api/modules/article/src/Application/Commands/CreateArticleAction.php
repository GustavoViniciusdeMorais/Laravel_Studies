<?php

namespace GustavoMorais\Article\Application\Commands;

use GustavoMorais\Article\Application\BaseAction;
use GustavoMorais\Article\Domain\DataTransferObjects\ArticleData;
use GustavoMorais\Article\Domain\Entity\Article;

class CreateArticleAction extends BaseAction
{
    public function execute()
    {
        $articleData = ArticleData::fromArray($this->data);
        $article = new Article();
        $article->title = $articleData->title;
        $article->body = $articleData->body;
        $article->save();
        return $article;
    }
}
