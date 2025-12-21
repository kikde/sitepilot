<?php

use Illuminate\Support\Facades\Route;

// API v1 endpoints
Route::middleware('api')->prefix('api/v1')->group(function () {
    Route::post('/login', [\Dapunjabi\CoreAuth\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/logout', [\Dapunjabi\CoreAuth\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('/refresh', [\Dapunjabi\CoreAuth\Http\Controllers\Api\AuthController::class, 'refresh']);
    Route::get('/getMe', [\Dapunjabi\CoreAuth\Http\Controllers\Api\UserController::class, 'me']);
    Route::get('/getPermissions', [\Dapunjabi\CoreAuth\Http\Controllers\Api\UserController::class, 'permissions']);
});

