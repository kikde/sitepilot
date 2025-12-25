<?php
use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\DonarsController;
use Jcf\NgoSite\Http\Middleware\ShareNgoViewData;
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
Route::middleware(['web', 'auth', 'tenant', 'license', 'seat', 'permission:content.manage', ShareNgoViewData::class])->group(function () {
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

     // Home About section (editable content for frontend About tabs)
    Route::get('/home-about', [\Modules\Page\Http\Controllers\HomeAboutController::class, 'edit'])->name('home.about.edit');
    Route::post('/home-about', [\Modules\Page\Http\Controllers\HomeAboutController::class, 'update'])->name('home.about.update');

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

    // Receipt actions
    Route::post('/donations/{donation}/receipt', [DonarsController::class, 'adminGenerateReceipt'])
        ->name('donations.receipt.generate');
    Route::get('/donations/{donation}/receipt', [DonarsController::class, 'adminDownloadReceipt'])
        ->name('donations.receipt.download');
    Route::post('/donations/{donation}/email', [DonarsController::class, 'adminEmailReceipt'])
        ->name('donations.receipt.email');

    // ====== Events (admin UI only; views copied from jcf backend) ======
    // Keep these simple closures for now; replace with controller later.
    $eventMw = ['web', 'auth', 'tenant', 'license', 'seat', 'permission:content.manage', ShareNgoViewData::class];

    Route::middleware($eventMw)->group(function () {
        // List pages with safe defaults so blades render without DB layer
        Route::get('/admin-home/events', [\Modules\Page\Http\Controllers\EventController::class, 'index'])->name('admin.events.all');

        Route::get('/admin-home/events/category', function () {
            try {
                $cats = \Modules\Page\Entities\EventCategory::orderByDesc('id')->get();
            } catch (\Throwable $e) {
                $cats = collect();
            }
            return view('backend.events.all-events-category', [
                'all_category' => $cats,
            ]);
        })
            ->name('admin.events.category.all');

        Route::get('/admin-home/events/new', [\Modules\Page\Http\Controllers\EventController::class, 'create'])->name('admin.events.new');
        Route::post('/admin-home/events/new', [\Modules\Page\Http\Controllers\EventController::class, 'store'])->name('admin.events.store');

        Route::get('/admin-home/events/{id}/edit', [\Modules\Page\Http\Controllers\EventController::class, 'edit'])
            ->name('admin.events.edit');
        Route::post('/admin-home/events/{id}/edit', [\Modules\Page\Http\Controllers\EventController::class, 'update'])
            ->name('admin.events.update');

        // Actions (no-op placeholders so views don't 500 on route() helpers)
        Route::post('/admin-home/events/category/new', [\Modules\Page\Http\Controllers\EventCategoryController::class, 'store'])
            ->name('admin.events.category.new');
        Route::post('/admin-home/events/category/update', [\Modules\Page\Http\Controllers\EventCategoryController::class, 'update'])
            ->name('admin.events.category.update');
        Route::post('/admin-home/events/category/delete/{id}', [\Modules\Page\Http\Controllers\EventCategoryController::class, 'delete'])
            ->name('admin.events.category.delete');
        Route::post('/admin-home/events/category/bulk-action', [\Modules\Page\Http\Controllers\EventCategoryController::class, 'bulkAction'])
            ->name('admin.events.category.bulk.action');

        Route::post('/admin-home/events/clone', [\Modules\Page\Http\Controllers\EventController::class, 'clone'])->name('admin.events.clone');
        Route::post('/admin-home/events/delete/{id}', [\Modules\Page\Http\Controllers\EventController::class, 'delete'])
            ->name('admin.events.delete');

        // Optional supporting pages present in the jcf views directory
        Route::get('/admin-home/events/attendance', function () { return \View::first(['backend.events.event-attendance-all','ngo::backend.events.event-attendance-all']); })
            ->name('admin.events.attendance.all');
        Route::get('/admin-home/events/attendance/{id}', function ($id) { return \View::first(['backend.events.attendance-view','ngo::backend.events.attendance-view'], compact('id')); })
            ->name('admin.events.attendance.view');
        Route::get('/admin-home/events/attendance-report', function () { return \View::first(['backend.events.attendance-report','ngo::backend.events.attendance-report']); })
            ->name('admin.events.attendance.report');

        Route::get('/admin-home/events/payments', function () { return \View::first(['backend.events.event-payment-logs-all','ngo::backend.events.event-payment-logs-all']); })
            ->name('admin.events.payment.logs');
        Route::get('/admin-home/events/payments/{id}', function ($id) { return \View::first(['backend.events.payment-log-view','ngo::backend.events.payment-log-view'], compact('id')); })
            ->name('admin.events.payment.view');

        Route::get('/admin-home/events/page-manage', function () { return \View::first(['backend.events.page-manage','ngo::backend.events.page-manage']); })
            ->name('admin.events.page.manage');
        Route::get('/admin-home/events/page-settings', function () { return \View::first(['backend.events.event-page-settings','ngo::backend.events.event-page-settings']); })
            ->name('admin.events.page.settings');
        Route::get('/admin-home/events/single-page-settings', function () { return \View::first(['backend.events.event-single-page-settings','ngo::backend.events.event-single-page-settings']); })
            ->name('admin.events.single.settings');
    });



//--------------------------------Success Story------------------------------//

// Route::group(['prefix'=>'success-story-page','namespace'=>'Admin'],function (){
    //contact page
    Route::middleware(['web', 'auth', 'tenant', 'license', 'seat', 'permission:content.manage', ShareNgoViewData::class])->group(function () {
        Route::resource('/successstory','SuccessStoryController');
        Route::resource('/succes-story-category', 'SuccessStoryCategoryController');
    });
// });








