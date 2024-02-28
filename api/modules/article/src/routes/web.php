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
        Route::post('articles/graphql', ['uses' => 'ArticleController@graphql']);
    }
);
