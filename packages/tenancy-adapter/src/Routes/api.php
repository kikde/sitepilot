<?php

use Illuminate\Support\Facades\Route;
use Dapunjabi\TenancyAdapter\Http\Controllers\Api\TenantConfigController;

Route::middleware('api')->prefix('api/v1')->group(function () {
    Route::get('/tenant/config', [TenantConfigController::class, 'show']);
});

