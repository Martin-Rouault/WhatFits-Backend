<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('api');

Route::post('/login', [AuthController::class, 'login']); // TODO mettre des middleware pour bloquer le spam
Route::post('/register', [AuthController::class, 'register']);