<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // If platform admin is on a non-tenant host, show the platform dashboard instead of a tenant dashboard.
        try {
            $userId = Auth::id();
            $isSuperAdmin =
                (Auth::user()?->email === config('coreauth.superadmin.email')) ||
                DB::table('coreauth_role_user')->where('user_id', $userId)->where('role_slug', 'superadmin')->exists();

            $tenant = app(TenantManager::class)->current();
            if ($isSuperAdmin && !$tenant) {
                return redirect()->route('platform.dashboard');
            }

            // Customer admins should land on the legacy /home panel (NGO style) by default.
            if (!$isSuperAdmin && $tenant) {
                return redirect('/home');
            }
        } catch (\Throwable $e) {}

        return view('coreauth::dashboard');
    }
}
