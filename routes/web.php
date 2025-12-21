<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Jcf\NgoSite\Http\Controllers\FrontendController;
use Jcf\NgoSite\Http\Middleware\ShareNgoViewData;

Route::get('/', function () {
    $platformHost = parse_url((string) config('app.url', ''), PHP_URL_HOST);
    $host = request()->getHost();

    // Platform host: go to platform dashboard (login may be required).
    if ($platformHost && $host === $platformHost) {
        return redirect('/platform');
    }

    // Tenant hosts: serve NGO frontend at root (no /ngo prefix).
    if (class_exists(FrontendController::class)) {
        // Manually run the view-sharing middleware so frontend blades don't break.
        $mw = app(ShareNgoViewData::class);
        return $mw->handle(request(), function ($req) {
            $result = app(FrontendController::class)->home();
            return $result instanceof \Symfony\Component\HttpFoundation\Response ? $result : response($result);
        });
    }

    return view('welcome');
});

Route::get('/_platform', function () {
    return view('welcome');
});

Route::middleware(['web','auth','platform'])->get('/platform', function () {
    return view('admin.platform-dashboard');
})->name('platform.dashboard');

Route::middleware(['web','auth','platform'])->prefix('admin')->group(function () {
    Route::get('/demo', function () {
        return view('admin.demo');
    });
});

// Public tenant resolver debug (safe): helps verify domain->tenant mapping locally.
Route::middleware(['web'])->get('/_tenant/resolve', function (Request $request) {
    $t = function_exists('currentTenant') ? currentTenant() : null;
    $coreTenant = null;
    try {
        if (class_exists(\Dapunjabi\CoreAuth\Support\TenantManager::class)) {
            $coreTenant = app(\Dapunjabi\CoreAuth\Support\TenantManager::class)->current();
        }
    } catch (\Throwable $e) {
        $coreTenant = null;
    }
    return response()->json([
        'host' => $request->getHost(),
        'path' => $request->path(),
        'resolved' => (bool) $t,
        'via' => $request->attributes->get('tenant_resolved_via'),
        'coreauth_tenant' => $coreTenant ? [
            'id' => $coreTenant->id ?? null,
            'slug' => $coreTenant->slug ?? null,
            'name' => $coreTenant->name ?? null,
        ] : null,
        'tenant' => $t ? [
            'id' => $t->id ?? null,
            'slug' => $t->slug ?? null,
            'name' => $t->name ?? null,
            'status' => $t->status ?? null,
        ] : null,
    ]);
});

// Convenience redirects for legacy module admin URLs (modules are mounted at root, not /admin).
Route::middleware(['web', 'auth'])->prefix('admin')->group(function () {
    Route::redirect('/pages', '/pages');
    Route::redirect('/newsList', '/newsList');
    Route::redirect('/donors', '/donors');
    Route::redirect('/donations', '/donations');
    Route::redirect('/users', '/users');
});
