<?php

use Illuminate\Support\Facades\Route;
use Modules\Collage\Http\Controllers\CollageController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/tools/collage-maker', [CollageController::class, 'index'])->name('collage.index');
});

