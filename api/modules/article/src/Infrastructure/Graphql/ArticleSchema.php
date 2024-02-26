<?php

namespace GustavoMorais\Article\Infrastructure\Graphql;

use GraphQL\Type\Schema;
use Illuminate\Support\ServiceProvider;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GustavoMorais\Article\Infrastructure\Graphql\ArticleType;
use GustavoMorais\Article\Infrastructure\Graphql\ArticleQuery;

class ArticleSchema extends ServiceProvider
{
    protected $queries = [
        ArticleQuery::class,
    ];

    public function boot(): void
    {
        GraphQL::addType(ArticleType::class);
    }

    public function register()
    {
        $this->app->singleton('graphql', function ($app) {
            return new GraphQL();
        });
    }

    public function schema(): Schema
    {
        return GraphQL::schema([
            'query' => $this->queries,
        ]);
    }
}
