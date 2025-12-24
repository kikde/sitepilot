<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Modules\User\Http\Controllers\ApiShotWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes (no CSRF)
|--------------------------------------------------------------------------
*/

Route::get('/ping', fn () => response()->json(['ok' => true]));

/** Webhook endpoints (both paths hit the same handler) */
Route::post('/apishot/webhook',  [ApiShotWebhookController::class, 'handle'])->name('apishot.webhook');
Route::post('/apishot/datasink', [ApiShotWebhookController::class, 'handle'])->name('apishot.datasink');


