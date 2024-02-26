<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GustavoMorais\Article\Infrastructure\Graphql\ArticleSchema;

Route::get('api/articles/check', function () {
    return new JsonResponse([
        'status' => 'success',
        'message' => 'Article test',
        'data' => true
    ]);
});

Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'GustavoMorais\Article\Infrastructure\Controllers'
    ],
    function () {
        Route::get('articles', ['uses' => 'ArticleController@listArticles']);
        Route::post('articles', ['uses' => 'ArticleController@createArticle']);
        Route::get('articles/graphql', function(Request $request) {
            $schema = app(ArticleSchema::class);
            $query = $request->input('query');
            $variables = $request->input('variables', []);
            $operationName = $request->input('operationName');
            $context = [];
            $result = $schema->executeQuery($query, $variables, $context, $operationName);
            
            return $result;
        });
    }
);
