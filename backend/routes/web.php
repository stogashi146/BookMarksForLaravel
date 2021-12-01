<?php

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

// Route::get('/', function () {
//     return view('home/about');
// });
Auth::routes();

// Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@about')->name('home');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get("/books", "BookController@index")->name("books.list");
    Route::post("/book", "BookController@store")->name("book.store");
    Route::get("/book/{id}", "BookController@show")->name("book.detail");
    Route::get('/book/ranking', 'BookController@ranking')->name('book.ranking');
// });
    Route::resource("user", "UserController",["only" => ["show", "edit", "update"]]);

Route::group(['middleware' => 'auth'], function () {
    
});




