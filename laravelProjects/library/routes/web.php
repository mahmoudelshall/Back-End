<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('isLoginAdmin')->group(function () {
    //Books: create 
    Route::get('/books/create', 'BookController@create')->name('books.create');
    Route::post('/books/store', 'BookController@store')->name('books.store');

    //Books: Edit
    Route::get('/books/edit/{id}', 'BookController@edit')->name('books.edit');
    Route::post('/books/update/{id}', 'BookController@update')->name('books.update');

    // Books:delete
    Route::get('/books/delete/{id}', 'BookController@delete')->name('books.delete');

    //Categories: create 
    Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('/categories/store', 'CategoryController@store')->name('categories.store');

    //Categories: Edit
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::post('/categories/update/{id}', 'CategoryController@update')->name('categories.update');

    // Categories:delete
    Route::get('/categories/delete/{id}', 'CategoryController@delete')->name('categories.delete');
});


Route::middleware('isLogin')->group(function () {
    // logout
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');
});
Route::middleware('isGuest')->group(function () {
    // register 
    Route::get('/register', 'AuthController@register')->name('auth.register');
    Route::post('/handle-register', 'AuthController@handleRegister')->name('auth.handleRegister');

    // login 
    Route::get('/login', 'AuthController@login')->name('auth.login');
    Route::post('/handle-login', 'AuthController@handleLogin')->name('auth.handleLogin');
});
// Books: read
Route::get('/books', 'BookController@index')->name('books.index');
Route::get('/books/withsearch', 'BookController@withsearch')->name('books.indexwithsearch');
Route::get('/books/search', 'BookController@search')->name('books.search');

Route::get('/books/show/{id}', 'BookController@show')->name('books.show');



// Categories: read
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/show/{id}', 'CategoryController@show')->name('categories.show');

Route::get('/auth/redirect', 'AuthController@redirectToProvider')->name('auth.github.redirect');

Route::get('/auth/callback','AuthController@handleProviderCallback')->name('auth.github.callback');
