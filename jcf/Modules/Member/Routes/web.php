<?php

use Illuminate\Support\Facades\Route;

// ✅ no leading slashes; strings are OK because namespace() is set
Route::resource('members', 'MemberController');

Route::get('member/{id}/{type}/active',   'MemberController@memberActive');
Route::get('member/{id}/{type}/deactive', 'MemberController@memberDeactive');

Route::get('membercard/{id}',      'MemberController@membersCard');
Route::get('download/idcard/{id}', 'MemberController@downloadIdcard');

Route::match(['get','post'], 'city-listby', 'MemberController@getcity');

Route::resource('category', 'CategoryController');

