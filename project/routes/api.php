<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('products/create', [ProductsController::class, 'store'])->name('product.store');
Route::put('products/{id}/edit', [ProductsController::class, 'update'])->name('product.update');
Route::delete('products/{id}/delete', [ProductsController::class, 'destroy'])->name('product.destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
