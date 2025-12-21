<?php
use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\DonarsController;
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

// Route::prefix('page')->group(function() {
//     Route::get('/', 'PageController@index');
// });

// Tenant admin content routes (must be logged in, in tenant context, with content permission).
Route::middleware(['web', 'auth', 'tenant', 'license', 'seat', 'permission:content.manage'])->group(function () {
    Route::resource('/pages', 'PageController');     //objective

    Route::get('/pageList', 'PageController@pageList');       // create New Page
    Route::get('/page/create', 'PageController@createNew');
    Route::post('/addnew', 'PageController@storePage');
    Route::get('/page-edit/{id}', 'PageController@showPage');
    Route::put('/page-update/{id}', 'PageController@updatePage');
    Route::delete('/page-del/{id}', 'PageController@deletePage');

    //--------------------------------News Post------------------------------//
    Route::get('/newsList', 'PageController@newsList');
    Route::get('/news/create', 'PageController@createPost');
    Route::post('/addnews', 'PageController@storePost');
    Route::get('/news-edit/{id}', 'PageController@showPost');
    Route::put('/news-update/{id}', 'PageController@updatePost');
    Route::delete('/news-del/{id}', 'PageController@deletePost');
    Route::post('/upload-quill-image', 'PageController@quillImage')->name('quill.image');
    Route::post('/ckeditor-upload', 'PageController@ckeditorUpload')->name('ckeditor.upload');

    Route::resource('/testimonials', 'TestimonialController');
    Route::resource('/management-team', 'ManageteamController');
    Route::resource('/faqs', 'FaqController');

    //=============================================Donors & Donations ===============================//
    Route::resource('/donors','DonarsController');

    Route::get('/city-list', 'DonarsController@listCity');
    Route::post('/city-list', 'DonarsController@listCity');

    Route::get('/addbreadcrum', 'DonarsController@getbanner');
    Route::post('/banner', 'DonarsController@bannerStore');

    /** Admin creates a donation for an existing donor (from the edit page) */
    Route::post('/donors/{donor}/donations', [DonarsController::class, 'adminCreateDonation'])
        ->name('admin.donations.store');

    /** Donations list (with donor details) */
    Route::get('/donations', [DonarsController::class, 'donationsIndex'])
        ->name('donations.index');

    // Bank details (admin-managed)
    Route::get('/bank-details', [DonarsController::class, 'bankIndex'])->name('donations.bank-details');
    Route::post('/bank-details', [DonarsController::class, 'storeBank'])->name('donations.bank.store');
    Route::put('/bank-details/{bank}', [DonarsController::class, 'updateBank'])->name('donations.bank.update');
    Route::delete('/bank-details/{bank}', [DonarsController::class, 'destroyBank'])->name('donations.bank.destroy');

    /*
    |--------------------------------------------------------------------------
    | Home page sections (legacy admin links)
    |--------------------------------------------------------------------------
    */
    Route::prefix('home')->group(function () {
        Route::get('/banner-list', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'bannerList']);
        Route::post('/banner', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'bannerStore']);
        Route::put('/banner/{id}', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'bannerUpdate']);
        Route::delete('/banner/{id}', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'bannerDestroy']);

        Route::get('/what-to-do-list', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'whatToDoList']);
        Route::post('/what-to-do', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'whatToDoStore']);
        Route::put('/what-to-do/{id}', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'whatToDoUpdate']);
        Route::delete('/what-to-do/{id}', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'whatToDoDestroy']);

        Route::get('/static-section', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'staticSection']);
        Route::put('/static-section', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'staticSectionUpdate']);

        Route::get('/award-section', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'awardSection']);
        Route::post('/award-section', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'awardSectionStore']);
        Route::put('/award-section/{id}', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'awardSectionUpdate']);
        Route::delete('/award-section/{id}', [\Modules\Page\Http\Controllers\HomeSectionController::class, 'awardSectionDestroy']);
    });
});

// UPI Autopay (Donation) - public callbacks (payment gateway)
Route::post('/donation/autopay/start', [DonarsController::class, 'startDonationAutopay'])
    ->name('donate.autopay.start');
Route::post('/donation/autopay/callback', [DonarsController::class, 'autopayCallback'])
    ->name('donate.autopay.callback');

//==================================Donations Ends========================================//


//--------------------------------Success Story------------------------------//

// Route::group(['prefix'=>'success-story-page','namespace'=>'Admin'],function (){
    //contact page
    Route::middleware(['web', 'auth', 'tenant', 'license', 'seat', 'permission:content.manage'])->group(function () {
        Route::resource('/successstory','SuccessStoryController');
        Route::resource('/succes-story-category', 'SuccessStoryCategoryController');
    });
// });
