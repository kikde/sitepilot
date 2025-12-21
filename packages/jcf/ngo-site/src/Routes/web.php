<?php

use Illuminate\Support\Facades\Route;
use Jcf\NgoSite\Http\Controllers\FrontendController;
use Jcf\NgoSite\Http\Controllers\PublicGalleryController;
use Jcf\NgoSite\Http\Middleware\ShareNgoViewData;
use Modules\Page\Http\Controllers\DonarsController;

Route::get('/_ngo/health', function () {
    return response()->json(['ok' => true, 'plugin' => 'jcf/ngo-site']);
});

// Payment / webhook routes used by legacy blades (non-prefixed).
if (config('ngo-site.legacy_payment_routes', true)) {
    Route::post('/donate/start', [DonarsController::class, 'startDonation'])->name('donate.start');
    Route::post('/donate/callback', [DonarsController::class, 'callback'])->name('donate.callback');
    Route::post('/razorpay/webhook', [DonarsController::class, 'webhook'])->name('razorpay.webhook');
    Route::get('/donation-cancelled', [DonarsController::class, 'donationCancelled'])->name('donation.cancelled');
}

Route::middleware([ShareNgoViewData::class])->group(function () {
    $mount = trim((string) config('ngo-site.mount_path', 'ngo'), '/');
    if ($mount === '') {
        $mount = 'ngo';
    }

    // Primary mounted NGO site routes: /{mount}/...
    Route::prefix($mount)->group(function () {
        Route::get('/', [FrontendController::class, 'home']);
        Route::get('/_landing', fn () => view('ngo::landing'));

        Route::get('/about', [FrontendController::class, 'about']);
        Route::get('/contact', [FrontendController::class, 'contact']);
        Route::get('/faq', [FrontendController::class, 'faq']);

        Route::get('/our-management-body', [FrontendController::class, 'managementTeam']);
        Route::get('/our-donors', [FrontendController::class, 'donors']);
        Route::get('/our-members', [FrontendController::class, 'members']);

        Route::get('/user-donate', [FrontendController::class, 'donateNow']);
        Route::get('/crowdfunding', [FrontendController::class, 'crowdfunding']);
        Route::get('/crowdfunding/{id}/{slug?}', [FrontendController::class, 'crowdfundingDetails']);

        Route::get('/news-post', [FrontendController::class, 'newsIndex']);
        Route::get('/news-details/{id}/{slug?}', [FrontendController::class, 'newsDetails']);

        Route::get('/complain-form', [FrontendController::class, 'complainForm']);

        Route::get('/success-story', [FrontendController::class, 'successStories']);
        Route::get('/success-story-details/{id}/{slug?}', [FrontendController::class, 'successStoryDetails']);
        Route::get('/categoryby/{id}', [FrontendController::class, 'successStoriesByCategory']);

        Route::get('/objective-details/{id}/{slug?}', [FrontendController::class, 'objectiveDetails']);

        Route::get('/terms-and-conditions', [FrontendController::class, 'terms']);
        Route::get('/privacy-policy', [FrontendController::class, 'privacy']);
        Route::get('/cancellation-and-refund-policy', [FrontendController::class, 'cancellationsAndRefunds']);

        Route::get('/photo-gallery', [PublicGalleryController::class, 'photos'])->name('front.photo');
        Route::get('/video-gallery', [PublicGalleryController::class, 'videos']);

        Route::post('/donate/start', [DonarsController::class, 'startDonation'])->name('ngo.donate.start');
        Route::post('/donate/callback', [DonarsController::class, 'callback'])->name('ngo.donate.callback');
        Route::post('/razorpay/webhook', [DonarsController::class, 'webhook'])->name('ngo.razorpay.webhook');
        Route::get('/donation-cancelled', [DonarsController::class, 'donationCancelled'])->name('ngo.donation.cancelled');
    });

    // Legacy URLs (non-prefixed). Keep enabled while migrating menus/links.
    if (config('ngo-site.legacy_routes', true)) {
        Route::get('/about', [FrontendController::class, 'about']);
        Route::get('/contact', [FrontendController::class, 'contact']);
        Route::get('/faq', [FrontendController::class, 'faq']);

        Route::get('/our-management-body', [FrontendController::class, 'managementTeam']);
        Route::get('/our-donors', [FrontendController::class, 'donors']);
        Route::get('/our-members', [FrontendController::class, 'members']);

        Route::get('/user-donate', [FrontendController::class, 'donateNow']);
        Route::get('/crowdfunding', [FrontendController::class, 'crowdfunding']);
        Route::get('/crowdfunding/{id}/{slug?}', [FrontendController::class, 'crowdfundingDetails']);

        Route::get('/news-post', [FrontendController::class, 'newsIndex']);
        Route::get('/news-details/{id}/{slug?}', [FrontendController::class, 'newsDetails']);

        Route::get('/complain-form', [FrontendController::class, 'complainForm']);

        Route::get('/success-story', [FrontendController::class, 'successStories']);
        Route::get('/success-story-details/{id}/{slug?}', [FrontendController::class, 'successStoryDetails']);
        Route::get('/categoryby/{id}', [FrontendController::class, 'successStoriesByCategory']);

        Route::get('/objective-details/{id}/{slug?}', [FrontendController::class, 'objectiveDetails']);

        Route::get('/terms-and-conditions', [FrontendController::class, 'terms']);
        Route::get('/privacy-policy', [FrontendController::class, 'privacy']);
        Route::get('/cancellation-and-refund-policy', [FrontendController::class, 'cancellationsAndRefunds']);

        Route::get('/photo-gallery', [PublicGalleryController::class, 'photos']);
        Route::get('/video-gallery', [PublicGalleryController::class, 'videos']);
    }
});
