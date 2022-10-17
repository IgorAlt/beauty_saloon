<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
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
    Route::get('/masters', [MasterController::class, 'index'])->name('masters');
    Route::get('/masters/{master}', [MasterController::class, 'show'])->name('master');
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/{post}', [PostController::class, 'post'])->name('post');
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');
    Route::post('/create-appointment', [AppointmentController::class, 'createAppointment'])->name('create-appointment');
    Route::middleware(['auth:sanctum'])->group(function (){
        Route::middleware(['cur_user'])->group(function () {
            Route::get('/change-user-information/{user}', [HomeController::class, 'change'])->name('change-user-information');
            Route::put('/update-user-information/{user}', [HomeController::class, 'update'])->name('update-user-information');
            Route::delete('/appointment_delete/{userAppointmentsFuture}', [HomeController::class, 'destroy'])->name('appointment_delete');
        });
        Route::group(['middleware' => 'is_admin'], function (){
            Route::get('/admin', [AdminController::class, 'index'])->name('admin');

            Route::resource('masters_admin', 'MasterAdminController');
            Route::resource('services_admin', 'ServiceAdminController');
            Route::resource('posts_admin', 'PostAdminController');
            Route::resource('appointments_admin', 'AppointmentAdminController');
            Route::resource('user-admin', 'UserAdminController');
            Route::resource('coupons', 'CouponController');
        });
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });
});

Auth::routes();


