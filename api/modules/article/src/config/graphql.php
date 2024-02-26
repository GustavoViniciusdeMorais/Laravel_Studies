<?php

use GustavoMorais\Article\Infrastructure\Graphql\ArticleQuery;
use GustavoMorais\Article\Infrastructure\Graphql\ArticleType;

return [
    'route' => [
        // The prefix for routes; do NOT use a leading slash!
        'prefix' => 'graphql',

        // The controller/method to use in GraphQL request.
        // Also supported array syntax: `[\Rebing\GraphQL\GraphQLController::class, 'query']`
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@query',

        // Any middleware for the graphql route group
        // This middleware will apply to all schemas
        'middleware' => [],

        // Additional route group attributes
        //
        // Example:
        //
        // 'group_attributes' => ['guard' => 'api']
        //
        'group_attributes' => [],
    ],

    'schemas' => [
        'default' => [
            'query' => [
                'user' => ArticleQuery::class,
            ],
            'method' => ['GET'],
        ],
    ],

    'types' => [
            'user' => ArticleType::class,
    ],
];
