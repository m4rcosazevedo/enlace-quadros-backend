<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** @var Route $router */
$router->get('/categories', [App\Http\Controllers\Api\CategoriesController::class, 'index']);

$router->get('/products', [App\Http\Controllers\Api\ProductsController::class, 'index']);
$router->get('/products/{categorySlug}/{slug}', [App\Http\Controllers\Api\ProductsController::class, 'show']);

$router->post('/newsletter', [App\Http\Controllers\Api\NewsletterController::class, 'store']);
