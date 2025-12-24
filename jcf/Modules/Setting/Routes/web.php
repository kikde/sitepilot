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

// Route::prefix('setting')->group(function() {
//     Route::get('/', 'SettingController@index');
// });

Route::resource('/settings', 'SettingController');

/*----------------------------------------------------
  |      SITEMAP SETTINGS
 ----------------------------------------------------*/

    //smtp settings
    // Route::get('/smtp-settings','GeneralSettingsController@smtp_settings')->name('admin.general.smtp.settings');

    Route::post('/smtp-settings','SettingController@update_smtp_settings');
    Route::post('/smtp-test', 'SettingController@test_smtp_settings');
    Route::get('send', 'SettingController@test');

    // Email Templates
    Route::resource('/email-templates', 'EmailTemplateController');
    Route::get('/email-templates/create', 'EmailTemplateController@create');
    Route::post('/email-templates/store', 'EmailTemplateController@store')->name('email-templates.store');
    Route::post('/email-templates/update', 'EmailTemplateController@update')->name('email-templates.update');

//SEO Setting
    Route::get('/seo-settings', 'SettingController@seo_settings')->name('admin.general.seo.settings');
    Route::post('/seo-settings', 'SettingController@update_seo_settings');

    Route::get('/payment-gateways', 'SettingController@editPayment');

     Route::post('/payment-gateways', 'SettingController@updatePayment');