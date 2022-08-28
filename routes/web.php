<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('register', 'Auth\RegisterController@chooseCategory')->name('register');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', 'PostController');

        Route::get('posts/{slug}', 'PostController@show')->name('posts.show');
        
        Route::get('categories', 'CategoryController@index')->name('categories.index');
        Route::get('categories/{slug}', 'CategoryController@show')->name('categories.show');

        Route::get('tags', 'TagController@index')->name('tags.index');
        Route::get('tags/{slug}', 'TagController@show')->name('tags.show');
    });


Route::get('/', 'GuestController@index');
Route::get('/search', 'SearchController@index');
Route::get('/restaurants', 'GuestController@restaurants');
Route::post('/update', 'SearchController@update')->name('search.update');
Route::get('/{id}', 'GuestController@show');

Route::get('{any?}', function() {
    return view('guest.index');
})->where('any', '.*');
