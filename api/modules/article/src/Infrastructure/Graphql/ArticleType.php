<?php

namespace GustavoMorais\Article\Infrastructure\Graphql;

use GraphQL\Type\Definition\Type;
use GustavoMorais\Article\Domain\Entity\Article;

class ArticleType
{
    protected $attributes = [
        'name' => 'article',
        'description' => 'A type',
        'model' => Article::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'ID do usuário'
            ],
            'title' => [
                'type' => Type::string(),
                'Article title'
            ],
            'body' => [
                'type' => Type::string(),
                'Article body'
            ],
        ];
    }
}
