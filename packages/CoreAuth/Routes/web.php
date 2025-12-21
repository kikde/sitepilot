<?php

use Illuminate\Support\Facades\Route;
use Dapunjabi\CoreAuth\Http\Controllers\Auth\RegisterController;
use Dapunjabi\CoreAuth\Http\Controllers\Auth\LoginController;
use Dapunjabi\CoreAuth\Http\Controllers\Auth\PasswordResetLinkController;
use Dapunjabi\CoreAuth\Http\Controllers\Auth\NewPasswordController;
use Dapunjabi\CoreAuth\Http\Controllers\ProfileController;
use Dapunjabi\CoreAuth\Http\Controllers\DashboardController;
use Dapunjabi\CoreAuth\Http\Controllers\TenantController;
use Dapunjabi\CoreAuth\Http\Controllers\AdminRoleController;
use Dapunjabi\CoreAuth\Http\Controllers\AdminPermissionController;
use Dapunjabi\CoreAuth\Http\Controllers\MfaSetupController;
use Dapunjabi\CoreAuth\Http\Controllers\MfaVerifyController;
use Dapunjabi\CoreAuth\Http\Controllers\SessionsController;
use Dapunjabi\CoreAuth\Http\Controllers\BillingController;
use Illuminate\Support\Facades\DB;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Dapunjabi\CoreAuth\Http\Controllers\InviteController;

// Package landing for quick verification
Route::group(['prefix' => 'coreauth', 'as' => 'coreauth.', 'middleware' => ['web']], function () {
    Route::get('/', function () { return view('coreauth::welcome'); })->name('index');
});

// Public routes (no login required)
Route::middleware(['web', 'guest'])->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // Login
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    // Password reset (request link)
    Route::get('/password/reset', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/password/email', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Password reset (actual reset)
    Route::get('/password/reset/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/password/reset', [NewPasswordController::class, 'store'])->name('password.update');

    // Invite accept (token-based)
    Route::get('/tenant/invite/accept/{token}', [InviteController::class, 'showAccept']);
    Route::post('/tenant/invite/accept', [InviteController::class, 'accept']);
});

// Protected routes (login required)
Route::middleware(['web', 'auth'])->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Profile
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('account.profile');
    Route::post('/account/profile', [ProfileController::class, 'update']);

    // Dashboard (simple landing after auth)
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['tenant','license','seat'])->name('dashboard');

    // Tenant selector
    Route::get('/tenant/select', [TenantController::class, 'select'])->name('tenant.select');
    Route::post('/tenant/select', [TenantController::class, 'set']);

    // Admin pages (require tenant + permission)
    Route::middleware(['tenant', 'license', 'permission:manage-roles'])->group(function () {
        Route::get('/admin/roles', [AdminRoleController::class, 'index'])->name('admin.roles');
        Route::post('/admin/roles', [AdminRoleController::class, 'update']);
    });
    Route::middleware(['tenant', 'license', 'permission:manage-permissions'])->group(function () {
        Route::get('/admin/permissions', [AdminPermissionController::class, 'index'])->name('admin.permissions');
        Route::post('/admin/permissions', [AdminPermissionController::class, 'update']);
    });

    // Billing UI (always allowed for tenant users)
    Route::middleware(['tenant'])->group(function () {
        Route::get('/billing', [BillingController::class, 'index'])->name('billing');
        Route::post('/billing/invoices/{id}/pay', [BillingController::class, 'pay'])->name('billing.pay');
    });

    // Invite & Team Management
    Route::middleware(['tenant', 'license', 'permission:manage-roles'])->group(function () {
        Route::get('/tenant/invite', [InviteController::class, 'form'])->name('tenant.invite');
        Route::post('/tenant/invite', [InviteController::class, 'send']);
    });

    // MFA & sessions
    Route::get('/mfa/setup', [MfaSetupController::class, 'show']);
    Route::post('/mfa/setup', [MfaSetupController::class, 'enable']);
    Route::get('/mfa/verify', [MfaVerifyController::class, 'show']);
    Route::post('/mfa/verify', [MfaVerifyController::class, 'verify']);
    Route::get('/account/sessions', [SessionsController::class, 'index'])->name('account.sessions');
    Route::post('/account/sessions/{id}/revoke', [SessionsController::class, 'revoke']);

    // Impersonation & Audit (superadmin only, enforced in controllers)
    Route::get('/admin/impersonate', [\Dapunjabi\CoreAuth\Http\Controllers\AdminImpersonateController::class, 'index']);
    Route::post('/admin/impersonate/{id}', [\Dapunjabi\CoreAuth\Http\Controllers\AdminImpersonateController::class, 'start']);
    Route::post('/admin/impersonate/stop', [\Dapunjabi\CoreAuth\Http\Controllers\AdminImpersonateController::class, 'stop']);
    Route::get('/admin/audit', [\Dapunjabi\CoreAuth\Http\Controllers\AdminAuditController::class, 'index']);

    // Phase 8: Simple SPA shell (Vue + Vuetify via CDN)
    Route::get('/spa', function () { return view('coreauth::spa.index'); })->name('spa');
    Route::get('/coreauth/context', function (TenantManager $tm) {
        $user = auth()->user();
        $tenant = $tm->current();
        $tenantId = $tenant?->id;
        $roles = [];
        if ($user && $tenantId) {
            $roles = DB::table('coreauth_role_user')->where('user_id', $user->id)->where('tenant_id', $tenantId)->pluck('role_slug')->toArray();
        }
        return response()->json([
            'user' => $user ? ['id' => $user->id, 'name' => $user->name, 'email' => $user->email] : null,
            'tenant' => $tenant ? ['id' => $tenant->id, 'name' => $tenant->name, 'slug' => $tenant->slug, 'license' => $tenant->license_status ?? 'active'] : null,
            'roles' => $roles,
            'impersonating' => session()->has('impersonator_id'),
        ]);
    })->name('coreauth.context');

    // API docs (web reference)
    Route::get('/coreauth/api', function () { return view('coreauth::api.index'); })->name('coreauth.api');
});


