<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BuildController;
use App\Http\Controllers\API\EmailVerificationController;
use App\Http\Controllers\API\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('api');

Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');

Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');

Route::post('/forgot-password', [PasswordResetController::class, 'forgot'])->name('password.request');
Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');

Route::apiResource('builds', BuildController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('builds', BuildController::class)->only(['store', 'update', 'destroy']);
});
