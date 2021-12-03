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
    
// });
    Route::resource("book", "BookController",["only" => ["index", "show", "store"]]);
    Route::prefix('book')->group(function(){
        Route::get('ranking', 'BookController@ranking')->name('book.ranking');
    });
    Route::resource("read", "ReadController",["only" => ["show", "store", "destroy", "update"]]);
    Route::resource("unread", "UnreadController",["only" => ["store", "destroy"]]);
    

    Route::resource("user", "UserController",["only" => ["show", "edit", "update"]]);
    Route::get('user/{user}/reads', 'UserController@reads')->name('user.reads');
    Route::get('user/{user}/unreads', 'UserController@unreads')->name('user.unreads');
    Route::get('user/{user}/following', 'UserController@following')->name('user.following');
    Route::get('user/{user}/followers', 'UserController@followers')->name('user.followers');
    

Route::group(['middleware' => 'auth'], function () {
    
});




