<?php

use Illuminate\Support\Facades\Route;
use Modules\Watermark\Http\Controllers\WatermarkController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/tools/watermark', [WatermarkController::class, 'index'])->name('watermark.index');
});

