<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::prefix('partner')->group(function() {
//     Route::get('/', 'PartnerController@index');
// });


/*----------------------------------------------------------------------------------------------------------------------------
 | CLIENT AREA ROUTES
 |----------------------------------------------------------------------------------------------------------------------------*/
 Route::group(['prefix' => 'partner'], function () {
    Route::get('/', 'PartnerController@index')->name('admin.partner');
    Route::post('/', 'PartnerController@store');
    Route::post('/update', 'PartnerController@update')->name('admin.partner.update');
    Route::post('/delete/{id}', 'PartnerController@destroy')->name('admin.partner.delete');
    Route::post('/bulk-action', 'PartnerController@bulk_action')->name('admin.partner.bulk.action');
});

