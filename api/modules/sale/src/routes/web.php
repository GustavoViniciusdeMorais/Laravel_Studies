<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('api/sales/check', function () {
    return new JsonResponse([
        'status' => 'success',
        'message' => 'Sales test',
        'data' => true
    ]);
});
