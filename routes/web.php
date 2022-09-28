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
Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/', 'MainController@index')->name('main');
    Route::get('/masters', 'MasterController@index')->name('masters');
    Route::get('/services', 'ServiceController@index')->name('services');
    Route::get('/posts', 'PostController@index')->name('posts');
    Route::get('/posts/{post}', 'PostController@post')->name('post');
    Route::middleware(['auth:sanctum'])->group(function (){
        Route::get('/bonuses', 'BonusController@index')->name('bonuses');
        Route::get('/admin', 'AdminController@index')->name('admin');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
