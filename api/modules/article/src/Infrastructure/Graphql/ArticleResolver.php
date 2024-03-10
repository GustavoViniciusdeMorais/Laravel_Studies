<?php

namespace GustavoMorais\Article\Infrastructure\Graphql;

use GustavoMorais\Article\Domain\Entity\Article;
use GustavoMorais\Article\Domain\Repositories\ArticleRepository;

class ArticleResolver
{
    public static function resolve(ArticleRepository $repository)
    {
        return [
            'Query' => [
                'getArticles' => function($root, $args, $context) use ($repository) {
                    return $repository->findAll();
                },
            ]
        ];
    }
}
