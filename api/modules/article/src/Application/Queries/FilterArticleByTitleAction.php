<?php

namespace GustavoMorais\Article\Application\Queries;

use GustavoMorais\Article\Application\BaseAction;
use GustavoMorais\Article\Domain\Entity\Article;
use GustavoMorais\Article\Domain\Repositories\ArticleRepository;

class FilterArticleByTitleAction extends BaseAction
{
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }
    public function execute()
    {
        $articles = [];
        if (!empty($this->data) && isset($this->data['title'])) {
            $article = Article::fromArray($this->data);
            $articles = $this->repository->findEntities($article);
        }
        return $articles;
    }
}
