<?php

namespace GustavoMorais\Article\Application\Queries;

use GustavoMorais\Article\Application\BaseAction;
use GustavoMorais\Article\Domain\Entity\Article;
use GustavoMorais\Article\Domain\Repositories\ArticleRepository;

class GetArticlesAction extends BaseAction
{
    private $repository;
    
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }
    public function execute()
    {
        return $this->repository->findAll();
    }
}
