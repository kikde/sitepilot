<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MediaUploadController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\EventsCategoryController;
use App\Http\Controllers\Admin\HomePageManageController;
use App\Http\Controllers\Auth\VerificationController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::fallback(function () {
    return redirect()->to('/')->with('error', 'Page not found.');
});


//---------------------------------------Demo Start-------------------------------------------//

Route::middleware('theme')->get('/{theme}', function (string $theme) {
    // expect files like: resources/views/frontend/pages/demo1.blade.php, demo2.blade.php
    $view = "frontend.pages.$theme";
    return view()->exists($view) ? view($view) : abort(404);
})->where('theme', implode('|', config('themes.allowed')));
//---------------------------------------DemoSara End-------------------------------------------//


// Home
Route::get('/', [FrontendController::class, 'index'])->name('home')->name('landing');
// above route orginal below changed as per suggesiotn
// Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::post('/fetch-cities', [FrontendController::class, 'fetchCitiesByState'])
    ->name('fetch.cities');

// Short numeric demos: /demo1, /demo2, /demo3 ...
Route::get('/demo{num}', [FrontendController::class, 'demoNumeric'])
    ->where('num', '[0-9]+')
    ->name('demo.numeric');

// Existing foldered style (optional): /demo/demo-1
Route::get('/demo/{slug}', [FrontendController::class, 'demo'])
    ->where('slug', '[-a-z0-9]+')
    ->name('demo.show');

// Auth & dashboard (as you had)
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Keep this LAST if you still want flat slugs like /complaint-1 (otherwise remove it)
Route::get('/{slug}', [FrontendController::class, 'demo'])
    ->where('slug', '^(?:(?:demo|donation|complaint)-[a-z0-9\-]+)$')
    ->name('demo.flat');


//---------------------------------------Donation And Donors-------------------------------------------//
Route::get('/user-donate', [FrontendController::class, 'userDonate']);
// Route::resource('/', FrontendController::class);

// web.php
Route::post('/donate/start', [\Modules\Page\Http\Controllers\DonarsController::class, 'startDonation'])
    ->name('donate.start');
Route::post('/donate/callback', [\Modules\Page\Http\Controllers\DonarsController::class, 'callback'])
    ->name('donate.callback'); // Razorpay "success" form POST
Route::post('/razorpay/webhook', [\Modules\Page\Http\Controllers\DonarsController::class, 'webhook'])
    ->name('razorpay.webhook'); 
    
Route::get('/donation-cancelled', [\Modules\Page\Http\Controllers\DonationController::class, 'donationCancelled'])
    ->name('donation.cancelled');
    
    // set this in Razorpay dashboard
//---------------------------------------Members Page-------------------------------------------//


Route::get('/categoryby/{id}', [FrontendController::class, 'productby']);
Route::post('/searchby', [FrontendController::class, 'searchproduct']);
Route::get('/latest-product', [FrontendController::class, 'new_product']);

Route::get('/send-mail',[FrontendController::class, 'sendmail']);

Route::post('/send-mail',[FrontendController::class, 'sendmail']);
//---------------------------------------Members Page End-------------------------------------------//


//=======================================================About Section=======================================================//
Route::get('/contact', [FrontendController::class, 'contactus']);
Route::get('/about', [FrontendController::class, 'aboutUs']);
Route::get('/success-story', [FrontendController::class, 'successStory']);
Route::get('/success-story-details/{id}/{slug}', [FrontendController::class, 'story_Details']);
Route::get('/latest-story', [FrontendController::class, 'latestStory']);
Route::post('/searchstory', [FrontendController::class, 'searchStory']);

Route::get('/manager-login', [FrontendController::class, 'supportTicket']);
Route::get('/registers', [FrontendController::class, 'supportStore']);

Route::get('/news-post', [FrontendController::class, 'newsPost']);    //NEWS Link
Route::get('/news-details/{id}/{slug}', [FrontendController::class, 'news_Details']);
//=======================================================End About Section=======================================================//
Route::get('/404', [FrontendController::class, 'notfound']);


Route::get('/photo-gallery', [FrontendController::class, 'mediaPhoto'])->name('front.photo');
Route::get('/video-gallery', [FrontendController::class, 'mediaVideo']);

Route::get('/crowdfunding', [FrontendController::class, 'showfunding']); 
Route::get('/crowdfunding/{id}/{slug}', [FrontendController::class, 'fund_Details']);

//--------------------------------------Cleaned Page---------------------------------------------//

Route::get('/terms-and-conditions', [FrontendController::class, 'showTerms']);
Route::get('/privacy-policy', [FrontendController::class, 'showPrivacyPolicy']);

Route::get('/shipping-policy', [FrontendController::class, 'showShipping']);
Route::get('/cancellation-and-refund-policy', [FrontendController::class, 'showrefundPolicy']);

Route::get('/our-donors', [FrontendController::class, 'showDonors']);
Route::get('/faq', [FrontendController::class, 'showFaqs']);
Route::get('/our-management-body', [FrontendController::class, 'showManagementBody']);
Route::get('/our-members', [FrontendController::class, 'showMembers']);
Route::get('/event-all', [FrontendController::class, 'showEvents']);
Route::get('/event-details/{id}/{slug}', [FrontendController::class, 'event_Details']);
Route::get('/complain-form', [FrontendController::class, 'complainForm']);
//--------------------------------------Service Page---------------------------------------------//



// Route::get('/our-team', [FrontendController::class, 'teamManage']);

Route::get('/objective-details/{id}/{slug}', [FrontendController::class, 'create']);
//--------------------------------------Service Page End---------------------------------------------//

Route::get('/product-query/{id}', [FrontendController::class, 'query']);

Route::group(['middleware' => ['web','auth','prevent-back-history']], function(){

Auth::routes(['verify' => true]);

Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed', 'throttle:30,1']);
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/make-payment', [App\Http\Controllers\HomeController::class, 'makePay']);


// media upload routes for restrict user in demo mode
Route::get('/media-upload/page',[MediaUploadController::class, 'all_upload_media_images_for_page'])->name('admin.upload.media.images.page');
Route::post('/media-upload/delete',[MediaUploadController::class, 'delete_upload_media_file'])->name('admin.upload.media.file.delete');

 // media upload routes end
 Route::post('/media-upload/all',[MediaUploadController::class, 'all_upload_media_file'])->name('admin.upload.media.file.all');
 Route::post('/media-upload',[MediaUploadController::class, 'upload_media_file'])->name('admin.upload.media.file');
 Route::post('/media-upload/alt',[MediaUploadController::class, 'alt_change_upload_media_file'])->name('admin.upload.media.file.alt.change');

// media upload routes for restrict user in demo mode
Route::post('/media-upload/loadmore', [MediaUploadController::class, 'get_image_for_loadmore'])->name('admin.upload.media.file.loadmore');



 /*----------------------------------------------------------------------------------------------------------------------------
     | EVENTS ROUTES
     |----------------------------------------------------------------------------------------------------------------------------*/
     Route::group(['prefix' => 'events', 'namespace' => 'Admin'], function () {

        Route::get('', [EventsController::class,'all_events'])->name('admin.events.all');
        Route::get('/new', [EventsController::class,'new_event'])->name('admin.events.new');
        Route::post('/new', [EventsController::class,'store_event']);
        Route::get('/edit/{id}', [EventsController::class,'edit_event'])->name('admin.events.edit');
        Route::post('/update', [EventsController::class,'update_event'])->name('admin.events.update');
        Route::post('/delete/{id}', [EventsController::class,'delete_event'])->name('admin.events.delete');
        Route::post('/clone', [EventsController::class,'clone_event'])->name('admin.events.clone');
        Route::post('/bulk-action', [EventsController::class,'bulk_action'])->name('admin.events.bulk.action');

        // //event page settings
        Route::get('/page-settings', [EventsController::class,'page_settings'])->name('admin.events.page.settings');
        Route::post('/page-settings', [EventsController::class,'update_page_settings']);

        // //event single page settings
        Route::get('/single-page-settings', [EventsController::class,'single_page_settings'])->name('admin.events.single.page.settings');
        Route::post('/single-page-settings', [EventsController::class,'update_single_page_settings']);

        // //event attendance logs
        Route::get('/event-attendance-logs', [EventsController::class,'event_attendance_logs'])->name('admin.event.attendance.logs');
        Route::post('/event-attendance-logs', [EventsController::class,'update_event_attendance_logs_status']);
        Route::post('/event-attendance-logs/delete/{id}', [EventsController::class,'delete_event_attendance_logs'])->name('admin.event.attendance.logs.delete');
        Route::post('/event-attendance-logs/send-mail', [EventsController::class,'send_mail_event_attendance_logs'])->name('admin.event.attendance.send.mail');
        Route::post('/event-attendance-logs/bulk-action', [EventsController::class,'attendance_logs_bulk_action'])->name('admin.event.attendance.bulk.action');
        Route::post('/event-attendance/reminder', [EventsController::class,'event_attedance_reminder'])->name('admin.event.attendance.reminder');
        Route::get('/event-attendance/view/{id}', [EventsController::class,'event_attendance_view'])->name('admin.event.attendance.view');
        //event payment logs
        Route::get('/event-payment-logs', [EventsController::class,'event_payment_logs'])->name('admin.event.payment.logs');
        Route::post('/event-payment-logs/delete/{id}', [EventsController::class,'delete_event_payment_logs'])->name('admin.event.payment.delete');
        Route::post('/event-payment-logs/approve/{id}', [EventsController::class,'approve_event_payment'])->name('admin.event.payment.approve');
        Route::post('/event-payment-logs/bulk-action', [EventsController::class,'payment_logs_bulk_action'])->name('admin.event.payment.bulk.action');
        Route::get('/event-payment-logs/view/{id}',[EventsController::class,'payment_logs_view'])->name('admin.event.payment.view');

        Route::get('/payment/report', [EventsController::class,'payment_report'])->name('admin.event.payment.report');
        Route::get('/attendance/report', [EventsController::class,'attendance_report'])->name('admin.event.attendance.report');

    });


  /*----------------------------------------------------------------------------------------------------------------------------
     | EVENTS ROUTES
     |----------------------------------------------------------------------------------------------------------------------------*/
     Route::group(['prefix' => 'events', 'namespace' => 'Admin'], function () {
        Route::get('/category', [EventsCategoryController::class,'all_events_category'])->name('admin.events.category.all');
        Route::post('/category/new', [EventsCategoryController::class,'store_events_category'])->name('admin.events.category.new');
        Route::post('/category/update', [EventsCategoryController::class,'update_events_category'])->name('admin.events.category.update');
        Route::post('/category/delete/{id}', [EventsCategoryController::class,'delete_events_category'])->name('admin.events.category.delete');
        Route::post('/category/lang', [EventsCategoryController::class,'Category_by_language_slug'])->name('admin.events.category.by.lang');
        Route::post('/category/bulk-action', [EventsCategoryController::class,'bulk_action'])->name('admin.events.category.bulk.action');

    });
/*----------------------------------------------------------------------------------------------------------------------------
     | EVENTS PAGE MANAGE ROUTES
     |----------------------------------------------------------------------------------------------------------------------------*/
    //  Route::group(['prefix' => 'events', 'namespace' => 'Admin'], function () {
    //     Route::get('/page-manage',[EventsPageManageController::class,'events_page_manage'])->name('admin.event.page.manage');
    //     Route::post('/page-manage',[EventsPageManageController::class,'update_events_page_manage']);
    // });


    /*----------------------------------------------------------------------------------------------------------------------------
     | HOME PAGE MANAGE ROUTES
     |----------------------------------------------------------------------------------------------------------------------------*/
     Route::group(['prefix' => 'home', 'namespace' => 'Admin'], function () {
        Route::get('/banner-list',[HomePageManageController::class,'homeBanner']);

        Route::get('/add-new',[HomePageManageController::class,'createBanner']);

        Route::post('/add-banner',[HomePageManageController::class,'storeNew']);

        Route::get('/edit/{id}',[HomePageManageController::class,'bannnerShow']);

        Route::put('/update/{id}',[HomePageManageController::class,'bannerUpdate']);

        Route::delete('/delete/{id}',[HomePageManageController::class,'bannerDelete']);

       //==============================WHAT_WE_DO=====================================//
        Route::get('/todo-list',[HomePageManageController::class,'homeTodo']);

        Route::get('/add-todo',[HomePageManageController::class,'createTodo']);

        Route::post('/add-todo',[HomePageManageController::class,'storeTodo']);

        Route::get('/edit-todo/{id}',[HomePageManageController::class,'todoShow']);

        Route::put('/todo-update/{id}',[HomePageManageController::class,'todoUpdate']);

        Route::delete('/delete-todo',[HomePageManageController::class,'todoDelete']);

        //===================================AWARD SECTION====================================//

        Route::get('/static-data',[HomePageManageController::class,'static_data']);

        Route::put('/static-data/{id}',[HomePageManageController::class,'storeStatic']);


        Route::get('/award-list',[HomePageManageController::class,'homeAward']);

        Route::get('/add-award',[HomePageManageController::class,'createAward']);

        Route::post('/add-award',[HomePageManageController::class,'storeAward']);

        Route::get('/edit-award/{id}',[HomePageManageController::class,'awardShow']);

        Route::put('/award-update/{id}',[HomePageManageController::class,'awardUpdate']);

        Route::delete('/delete-award',[HomePageManageController::class,'awardDelete']);



    });

});
//=========================================CRON Job=====================================//
Route::get('cron', function () {

    \Artisan::call('database:backup');



});

Route::get('cache-cron', function () {

    \Artisan::call('cache:clear');



});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
