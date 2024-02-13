<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use GustavoMorais\Article\Infrastructure\Controllers\ArticleController;

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
    }
);
