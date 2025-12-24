<?php

use Illuminate\Support\Facades\Route;
use Modules\BreakingNews\Http\Controllers\BreakingNewsController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/tools/breaking-news-maker', [BreakingNewsController::class, 'index'])->name('breaking.index');
});

