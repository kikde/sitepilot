<?php

use Illuminate\Support\Facades\Route;
use Modules\ApiShotWebhook\Http\Controllers\WebhookController;

/*
| Prefix under /api to keep consistent with Laravel API routes
*/
Route::prefix('api')->group(function () {
    // webhook receiver (keep)
    Route::post('/apishot/webhook', [WebhookController::class, 'handle'])
         ->name('apishot.webhook');

    // health (keep)
    Route::get('/ping-apishot', fn() => response()->json(['ok' => true, 'app' => config('app.name')]));

    // NEW: test endpoints so you can drive the full loop from mdmks only
    Route::post('/apishot/test-snapshot', [WebhookController::class, 'testCreate']); // create a job on Apishot
    Route::get('/apishot/test-latest',    [WebhookController::class, 'testLatest']); // show the latest saved event
});
