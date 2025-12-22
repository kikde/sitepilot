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

Route::middleware(['web','auth','tenant','license','seat','permission:content.manage'])->group(function () {
Route::resource('/settings', 'SettingController');
    Route::post('/settings/location', 'SettingController@update_location')->name('settings.location.update');

/*----------------------------------------------------
  |      SITEMAP SETTINGS
 ----------------------------------------------------*/

    //smtp settings
    // Route::get('/smtp-settings','GeneralSettingsController@smtp_settings')->name('admin.general.smtp.settings');

    Route::post('/smtp-settings','SettingController@update_smtp_settings');
    Route::post('/smtp-test', 'SettingController@test_smtp_settings');
    Route::get('send', 'SettingController@test');

    // Email Templates (explicit routes to avoid name collisions with resource update)
    Route::get('/email-templates', 'EmailTemplateController@index')->name('email-templates.index');
    Route::get('/email-templates/create', 'EmailTemplateController@create')->name('email-templates.create');
    Route::post('/email-templates/store', 'EmailTemplateController@store')->name('email-templates.store');
    Route::post('/email-templates/update', 'EmailTemplateController@update')->name('email-templates.update');

//SEO Setting
    Route::get('/seo-settings', 'SettingController@seo_settings')->name('admin.general.seo.settings');
    Route::post('/seo-settings', 'SettingController@update_seo_settings');

    Route::get('/payment-gateways', 'SettingController@editPayment');

     Route::post('/payment-gateways', 'SettingController@updatePayment');
});



