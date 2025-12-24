<?php

use Illuminate\Support\Facades\Route;
use Modules\Birthdays\Http\Controllers\BirthdaysController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/users/birthdays', [BirthdaysController::class, 'index'])->name('birthdays.index');
});

