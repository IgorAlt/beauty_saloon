<?php

use App\Http\Controllers\Api\v1\AppointmentController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\HomeController;
use App\Http\Controllers\Api\v1\MainController;
use App\Http\Controllers\Api\v1\MasterController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\ServiceController;
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
Route::group(['middleware' => 'auth:sanctum',], function (){
    Route::get('/home/{loginRequest}', [HomeController::class, 'index']);
    Route::get('/user_change', [HomeController::class, 'change']);
    Route::delete('/appointment_delete/{userAppointmentsFuture}', [HomeController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('/main', [MainController::class, 'index'])->name('api-main');
Route::get('/masters', [MasterController::class, 'index'])->name('api-masters');
Route::get('/masters/{master}', [MasterController::class, 'show'])->name('api-master');
Route::get('/services', [ServiceController::class, 'index'])->name('api-services');
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/appointment', [AppointmentController::class, 'index']);
Route::post('/appointment-create', [AppointmentController::class, 'create']);
Route::post('register', [AuthController::class, 'register'])->name('api-register');
Route::post('login', [AuthController::class, 'login']);
Route::post('token', [AuthController::class, 'token']);
