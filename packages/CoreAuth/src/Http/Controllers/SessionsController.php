<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session as SessionFacade;

class SessionsController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        $sessions = DB::table('coreauth_sessions')->where('user_id', Auth::id())->orderByDesc('last_activity')->get();
        return view('coreauth::account.sessions', ['sessions' => $sessions, 'current' => $request->session()->getId()]);
    }

    public function revoke(Request $request, int $id)
    {
        if (!Auth::check()) return redirect()->route('login');
        $row = DB::table('coreauth_sessions')->where('id', $id)->where('user_id', Auth::id())->first();
        if (!$row) return back();
        DB::table('coreauth_sessions')->where('id', $id)->update(['revoked_at' => now()]);
        // destroy session file/driver
        SessionFacade::getHandler()->destroy($row->session_id);
        // If revoking current session, logout and redirect to login
        if ($row->session_id === $request->session()->getId()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('status', 'Session revoked');
        }
        return back()->with('status', 'Session revoked');
    }
}

