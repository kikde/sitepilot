<?php

use Illuminate\Support\Facades\Route;
use Modules\ApiShotWebhook\Http\Controllers\ReceiptSignedController;

Route::middleware('signed')->group(function () {
    Route::get('/payment-receipt/signed/{id}', [ReceiptSignedController::class, 'show'])
        ->name('apishot.receipt.signed');
});

// Optional: simple health route for this module (no stubs, no placeholders)
Route::get('/apishot/health', function () {
    return response()->json(['ok' => true]);
});
