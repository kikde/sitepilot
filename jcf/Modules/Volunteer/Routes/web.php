<?php

use Illuminate\Support\Facades\Route;
use Modules\Volunteer\Http\Controllers\VolunteerController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');
});

