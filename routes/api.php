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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// route per chiamata api per filtrare le categorie
Route::get('/categories', 'Api\CategoryController@index');

// route per visualizzare lista ristoranti e singolo ristorante
Route::get('/users', 'Api\UserController@index')->name('api.users.index');
Route::get('/users/{slug}', 'Api\UserController@show')->name('api.users.show');
// route per ricerca lato server
Route::get('/users/ricerca', 'Api\UserController@ricerca');
