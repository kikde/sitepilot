<?php

use Illuminate\Support\Facades\Route;
use Modules\DailyPoster\Http\Controllers\DailyPosterController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/tools/daily-poster', [DailyPosterController::class, 'index'])->name('dailyposter.index');
});

