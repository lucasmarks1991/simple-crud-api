<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::group(['prefix' => 'users'], function() {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/me', [UserController::class, 'getLoggedUser']);
        });
    });

    Route::apiResource('/expenses', ExpenseController::class)->middleware('auth:sanctum');
});
