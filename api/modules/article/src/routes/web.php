<?php

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Route;

Route::get('api/articles/check', function () {
    return new JsonResponse([
        'status' => 'success',
        'message' => 'Article test',
        'data' => true
    ]);
});

Route::get('api/articles', function () {
    return new JsonResponse([
        'status' => 'success',
        'data' => true
    ]);
});
