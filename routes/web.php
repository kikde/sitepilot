<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/ngo');
});

Route::get('/_platform', function () {
    return view('welcome');
});

// Convenience redirects for legacy module admin URLs (modules are mounted at root, not /admin).
Route::middleware(['web', 'auth'])->prefix('admin')->group(function () {
    Route::redirect('/pages', '/pages');
    Route::redirect('/newsList', '/newsList');
    Route::redirect('/donors', '/donors');
    Route::redirect('/donations', '/donations');
    Route::redirect('/users', '/users');
});
