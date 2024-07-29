<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CommentsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products',[ProductsController::class, 'listarProdutos']);
Route::post('products',[ProductsController::class, 'store'])->name('products.save');
Route::put('products/{id}/edit',[ProductsController::class, 'alterar'])->name('products.update');
Route::delete('products/{id}',[ProductsController::class, 'destroy'])->name('product.delete');

Route::post('comments', [CommentsController::class, 'store'])->name('comment.save');
Route::get('comments', [CommentsController::class, 'index']);
Route::put('comments/{id}', [CommentsController::class, 'update'])->name('comment.update');
Route::delete('comments/{id}', [CommentsController::class, 'destroy'])->name('comment.delete');