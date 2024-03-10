<?php

namespace GustavoMorais\Article\Application\Commands;

use GustavoMorais\Article\Application\BaseAction;
use GustavoMorais\Article\Domain\Repositories\ArticleRepository;
use GustavoMorais\Article\Domain\Entity\Article;

class CreateArticleAction extends BaseAction
{
    private $repository;
    
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }
    public function execute()
    {
        $article = Article::fromArray($this->data);
        $this->repository->saveEntity($article);
        return $article;
    }
}
