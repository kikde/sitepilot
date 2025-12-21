<?php

use Illuminate\Support\Facades\Route;

// ✅ no leading slashes; strings are OK because namespace() is set
// Protect all member admin routes for tenants
Route::middleware(['web','auth','tenant','license','seat','permission:content.manage'])->group(function () {
    Route::resource('members', 'MemberController');
    Route::get('member/{id}/{type}/active',   'MemberController@memberActive');
    Route::get('member/{id}/{type}/deactive', 'MemberController@memberDeactive');
    Route::get('membercard/{id}',      'MemberController@membersCard');
    Route::get('download/idcard/{id}', 'MemberController@downloadIdcard');
    Route::match(['get','post'], 'city-listby', 'MemberController@getcity');
    // Category UI is handled via modals in index; keep only CRUD endpoints used by that page.
    Route::resource('category', 'CategoryController')->except(['create','edit','show']);
});
