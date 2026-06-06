<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BuildController;
use App\Http\Controllers\API\EmailVerificationController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\MakeController;
use App\Http\Controllers\API\PasswordResetController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WheelBrandController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');
Route::post('/forgot-password', [PasswordResetController::class, 'forgot'])->name('password.request');
Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::apiResource('users', UserController::class)->only(['show']);

Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    Route::apiResource('builds', BuildController::class)->only(['index', 'show']);
    Route::get('/makes', [MakeController::class, 'index']);
    Route::get('/makes/{make}/car-models', [MakeController::class, 'carModels']);
    Route::get('/wheel-brands', [WheelBrandController::class, 'index']);
    Route::get('/wheel-brands/{wheelBrand}/wheels', [WheelBrandController::class, 'wheels']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [UserController::class, 'me']);
        Route::apiResource('users', UserController::class)->only(['update', 'destroy']);
        Route::apiResource('builds', BuildController::class)->only(['store', 'update', 'destroy']);
        Route::post('/builds/{build}/like', [LikeController::class, 'toggle'])->middleware('throttle:10,1');
    });
});
