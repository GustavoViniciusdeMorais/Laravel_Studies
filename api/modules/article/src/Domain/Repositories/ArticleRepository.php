<?php

namespace GustavoMorais\Article\Domain\Repositories;

use GustavoMorais\Article\Domain\Entity\Article;

interface ArticleRepository
{
    public function saveEntity(Article $article): Article;
    public function findEntities(Article $article);
    public function findAll():array;
}
