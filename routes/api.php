<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MotelroomController;
use App\Http\Controllers\Api\AuthController;

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

// Public routes
Route::get('motelrooms', [MotelroomController::class, 'index']);
Route::get('motelrooms/{slug}', [MotelroomController::class, 'show']);
Route::get('motelrooms/search', [MotelroomController::class, 'search']);

// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Motelroom routes
    Route::post('motelrooms', [MotelroomController::class, 'store']);
    Route::put('motelrooms/{id}', [MotelroomController::class, 'update']);
    Route::delete('motelrooms/{id}', [MotelroomController::class, 'destroy']);
    
    // User routes
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
});
