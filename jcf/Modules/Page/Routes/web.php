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

// Admin: donation receipt actions
Route::middleware('auth')->group(function(){
    Route::post('/donations/{donation}/receipt/generate', [DonarsController::class, 'generateReceipt'])
        ->name('donations.receipt.generate');
    Route::get('/donations/{donation}/receipt/download', [DonarsController::class, 'downloadReceipt'])
        ->name('donations.receipt.download');
    Route::post('/donations/{donation}/receipt/email', [DonarsController::class, 'emailReceipt'])
        ->name('donations.receipt.email');
});

// UPI Autopay (Donation)
Route::post('/donation/autopay/start', [DonarsController::class, 'startDonationAutopay'])
    ->name('donate.autopay.start');

Route::post('/donation/autopay/callback', [DonarsController::class, 'autopayCallback'])
    ->name('donate.autopay.callback');

Route::middleware('auth')->group(function () {
    Route::get('/bank-details', [DonarsController::class, 'bankIndex'])->name('donations.bank-details');
    Route::post('/bank-details', [DonarsController::class, 'storeBank'])->name('donations.bank.store');
    Route::put('/bank-details/{bank}', [DonarsController::class, 'updateBank'])->name('donations.bank.update');
    Route::delete('/bank-details/{bank}', [DonarsController::class, 'destroyBank'])->name('donations.bank.destroy');

    // Home About section (editable content for frontend About tabs)
    Route::get('/home-about', [\Modules\Page\Http\Controllers\HomeAboutController::class, 'edit'])->name('home.about.edit');
    Route::post('/home-about', [\Modules\Page\Http\Controllers\HomeAboutController::class, 'update'])->name('home.about.update');

});

//==================================Donations Ends========================================//


//--------------------------------Success Story------------------------------//

// Route::group(['prefix'=>'success-story-page','namespace'=>'Admin'],function (){
    //contact page
    Route::resource('/successstory','SuccessStoryController');
    Route::resource('/succes-story-category', 'SuccessStoryCategoryController');
// });
