<?php

namespace GustavoMorais\Article\Infrastructure\Graphql;

use GustavoMorais\Article\Domain\Entity\Article;

class ArticleResolver
{
    public static function resolve()
    {
        return [
            'Query' => [
                'getArticles' => function($root, $args, $context) {
                    return Article::all();
                },
            ]
        ];
    }
}
