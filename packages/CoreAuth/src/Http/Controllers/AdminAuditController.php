<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class AdminAuditController extends Controller
{
    protected function ensureSuperadmin(): void
    {
        $user = Auth::user();
        if (!$user) abort(403);
        $sup = config('coreauth.superadmin.email');
        if (! $sup || strcasecmp($user->email, $sup) !== 0) {
            abort(403, 'Only superadmin may view audit logs.');
        }
    }

    public function index()
    {
        $this->ensureSuperadmin();
        $logs = DB::table('coreauth_audit_logs')->orderByDesc('created_at')->limit(200)->get();
        return view('coreauth::admin.audit', compact('logs'));
    }
}

