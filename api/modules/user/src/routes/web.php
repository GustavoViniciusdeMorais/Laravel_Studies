<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('api/users/check', function () {
    return new JsonResponse([
        'status' => 'success',
        'message' => 'User test',
        'data' => true
    ]);
});

Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'GustavoMorais\User\Infrastructure\Controllers'
    ],
    function () {
        Route::post('users', ['uses' => 'UserController@createUser']);
        Route::post('users/login', ['uses' => 'AuthController@login']);
    }
);