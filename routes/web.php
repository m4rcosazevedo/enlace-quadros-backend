<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/** @var Route $router */
$router->get('/', function () {
    return view('welcome');
});

Auth::routes();

$router->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

$router->group(['middleware' => ['auth'], 'prefix' => 'admin'], function () use ($router) {
    $router->group(['prefix' => 'category'], function () use ($router) {
        $router->get('/', 'App\Http\Controllers\CategoryController@index')->name('category.index');
        $router->get('/new', 'App\Http\Controllers\CategoryController@create')->name('category.create');
        $router->post('/new', 'App\Http\Controllers\CategoryController@store')->name('category.store');
        $router->get('/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');
        $router->put('/{id}', 'App\Http\Controllers\CategoryController@update')->name('category.update');
        $router->delete('/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('category.destroy');
    });

    $router->group(['prefix' => 'product'], function () use ($router) {
        $router->get('/', 'App\Http\Controllers\ProductController@index')->name('product.index');
        $router->get('/new', 'App\Http\Controllers\ProductController@create')->name('product.create');
        $router->post('/new', 'App\Http\Controllers\ProductController@store')->name('product.store');
        $router->get('/{id}', 'App\Http\Controllers\ProductController@edit')->name('product.edit');
        $router->put('/{id}', 'App\Http\Controllers\ProductController@update')->name('product.update');
        $router->delete('/{id}', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy');
    });
});

