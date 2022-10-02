<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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
    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::get('/masters', 'MasterController@index')->name('masters');
    Route::get('/services', 'ServiceController@index')->name('services');
    Route::get('/posts', 'PostController@index')->name('posts');
    Route::get('/posts/{post}', 'PostController@post')->name('post');
    Route::get('/appointment', 'AppointmentController@index')->name('appointment');
    Route::post('/create-appointment', 'AppointmentController@createAppointment')->name('create-appointment');
    Route::middleware(['auth:sanctum'])->group(function (){
        Route::get('/bonuses', 'BonusController@index')->name('bonuses');
        Route::group(['middleware' => 'is_admin'], function (){
            Route::get('/admin', 'AdminController@index')->name('admin');

            Route::resource('masters_admin', 'MasterAdminController');
            Route::resource('services_admin', 'ServiceAdminController');
            Route::resource('posts_admin', 'PostAdminController');
        });
        Route::get('/home', 'HomeController@index')->name('home');
    });
});

Auth::routes();


