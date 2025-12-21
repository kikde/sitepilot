<?php

use Illuminate\Support\Facades\Route;
use Dapunjabi\TenancyAdapter\Http\Controllers\TenantAdminController;
use Dapunjabi\TenancyAdapter\Http\Controllers\TenantMediaController;

Route::middleware(['web'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/tenants', [TenantAdminController::class, 'index'])->name('tenancy.admin.tenants.index');
        // Place fixed paths before dynamic {id} to avoid collisions
        Route::get('/tenants/create', [TenantAdminController::class, 'create'])->name('tenancy.admin.tenants.create');
        Route::post('/tenants', [TenantAdminController::class, 'store'])->name('tenancy.admin.tenants.store');
        Route::get('/tenants/{id}', [TenantAdminController::class, 'show'])->name('tenancy.admin.tenants.show');
        Route::get('/tenants/{id}/theme', [TenantAdminController::class, 'theme'])->name('tenancy.admin.tenants.theme');
        Route::post('/tenants/{id}/theme', [TenantAdminController::class, 'updateTheme'])->name('tenancy.admin.tenants.theme.update');
        Route::get('/tenants/{id}/domains', [TenantAdminController::class, 'domains'])->name('tenancy.admin.tenants.domains');
        Route::post('/tenants/{id}/domains', [TenantAdminController::class, 'addDomain'])->name('tenancy.admin.tenants.domains.add');
        Route::post('/tenants/{id}/status', [TenantAdminController::class, 'updateStatus'])->name('tenancy.admin.tenants.status');
    });

Route::middleware(['web'])->get('/tenant/debug', function () {
    $t = currentTenant();
    return response()->json([
        'resolved' => (bool) $t,
        'via' => request()->attributes->get('tenant_resolved_via'),
        'tenant' => $t ? [
            'id' => $t->id,
            'name' => $t->name,
            'slug' => $t->slug,
            'settings' => $t->settings,
        ] : null,
        'host' => request()->getHost(),
        'path' => request()->path(),
        'header' => request()->header(config('tenancy.resolver.header', 'X-Tenant-Slug')),
    ]);
})->name('tenancy.debug');

Route::middleware(['web'])->get('/tenant/posts', function () {
    $tenant = currentTenant();
    $posts = \Dapunjabi\TenancyAdapter\Models\Post::query()->latest()->get();
    return view('tenancy::tenant.posts', compact('tenant', 'posts'));
})->name('tenancy.posts');

// Feature-flagged sample routes
Route::middleware(['web', 'feature:pos'])->get('/tenant/pos', function () {
    $t = currentTenant();
    return response('<h3>POS Module</h3><p>Enabled for tenant: '.e($t?->name).'</p>');
})->name('tenancy.feature.pos');

Route::middleware(['web', 'feature:ecommerce'])->get('/tenant/shop', function () {
    $t = currentTenant();
    return response('<h3>Ecommerce Module</h3><p>Enabled for tenant: '.e($t?->name).'</p>');
})->name('tenancy.feature.ecommerce');

// Quota-checked media upload
Route::middleware(['web'])->group(function () {
    Route::get('/tenant/media', [TenantMediaController::class, 'index'])->name('tenancy.media.index');
    Route::post('/tenant/media', [TenantMediaController::class, 'store'])
        ->middleware('quota:storage_quota_mb')
        ->name('tenancy.media.store');
});
