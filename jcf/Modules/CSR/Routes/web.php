<?php

use Illuminate\Support\Facades\Route;
use Modules\CSR\Http\Controllers\CSRController;

Route::middleware(['web','auth'])->group(function(){
    Route::get('/csr', [CSRController::class, 'index'])->name('csr.index');
});

