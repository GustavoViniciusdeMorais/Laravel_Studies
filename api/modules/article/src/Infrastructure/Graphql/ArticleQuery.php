<?php

namespace GustavoMorais\Article\Infrastructure\Graphql;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GustavoMorais\Article\Domain\Entity\Article;

class ArticleQuery extends Query
{
    protected $attributes = [
        'name' => 'article',
        'description' => 'A query'
    ];

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Article ID'
            ],
        ];
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('article'));
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Article::all();
    }
}
