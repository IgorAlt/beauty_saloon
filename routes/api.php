<?php

use App\Http\Controllers\Api\v1\AppointmentController;
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

Route::get('/masters', [MasterController::class, 'index']);
Route::get('/masters/{master}', [MasterController::class, 'show']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/appointment', [AppointmentController::class, 'index']);
Route::post('/appointment-create', [AppointmentController::class, 'create']);
