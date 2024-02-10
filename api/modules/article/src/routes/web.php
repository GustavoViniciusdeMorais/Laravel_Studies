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

// Route::get('api/articles', function () {
//     return new JsonResponse([
//         'status' => 'success',
//         'data' => true
//     ]);
// });

// Route::get('/api/articles', 'GustavoMorais\Article\Infrastructure\Controllers\ArticleController@listArticles');
Route::get('/api/articles', [ArticleController::class, 'listArticles']);
