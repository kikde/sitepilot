<?php

use Illuminate\Support\Facades\Route;
use Modules\Branding\Http\Controllers\BrandingController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/branding', [BrandingController::class, 'index'])->name('branding.index');
});

