<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\Note;
use Modules\User\Entities\User;
use Modules\User\Entities\Payment;
use Intervention\Image\Facades\Image;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        // share basic setting like your old controller
        View::share(['setting' => Setting::first()]);
    }

    /** Member dashboard */
    public function index()
    {
        $me = Auth::user();
        if (!$me) {
            return redirect()->route('login');
        }

        // block inactive users (kept behavior)
        if ((int)$me->useractive === 0) {
            return back()->with('notfound', 'Please Contact admin for Your Account Activation');
        }

        // Admin → backend home
        if ((int)$me->role === 1) {
            return view('backend.home.home');
        }

        // Member / role 2 or 0 → dashboard
        if (in_array((int)$me->role, [0, 2], true)) {
            $id      = (int)$me->id;
            $mobile  = $me->mobile;

            // keep old variable names so your blade does not break
            $rec     = Payment::where('user_id', $id)->latest('id')->first();
            $perfor  = User::where('pow', 1)->first();
            $davit   = User::find($id);
            $top     = User::where('topten', 1)->limit(10)->get();
            $notice  = Note::latest()->limit(4)->get();

            return view('home', compact('perfor','top','mobile','rec','davit','notice'));
        }

        // role 3 (old behavior)
        if ((int)$me->role === 3) {
            return back()->with('message', 'Your are Successfully Register Come to Enjoy Your Day..');
        }

        // fallback
        return view('home');
    }

    /** Upload payment screenshot + queue affidavit render */
    public function makePay(Request $request)
    {
        $id = (int)Auth::id();

        // ensure a row exists (now allowed by fillable in step 3)
        $pay = Payment::firstOrCreate(['user_id' => $id], []);

        if ($request->hasFile('screenshot')) {
            $postimage = $request->file('screenshot');
            $filename  = '_prd_'. time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->save(public_path('/backend/screenshots/'. $filename));
            $pay->screenshot = $filename;
            $pay->save();
        }

        // Build a temporary signed URL for the public affidavit render route
        $base   = rtrim(config('member.viewbase') ?? env('VIEW_BASE', config('app.url')), '/');
        $scheme = parse_url($base, PHP_URL_SCHEME) ?: null;
        if ($base) {
            URL::forceRootUrl($base);
            if ($scheme) { URL::forceScheme($scheme); }
        }
        $affidavitUrl = URL::temporarySignedRoute('render.affidavit', now()->addSeconds(120), ['id' => $id]);

        // Kick APIshot (using your service class)
        $r = \Modules\User\Services\ApiShot::capture($id, $affidavitUrl, [
            'ext'             => 'pdf',
            'pageSize'        => 'A4',
            'printBackground' => true,
            'waitUntil'       => 'networkidle',
            'waitFor'         => 1200,
            'meta'            => ['user_id'=>$id, 'kind'=>'affidavit', 'suggest'=>"affidavit_{$id}_" . time() . ".pdf"],
            'datasinkMeta'    => ['user_id'=>$id, 'kind'=>'affidavit', 'suggest'=>"affidavit_{$id}_" . time() . ".pdf"],
        ]);

        if (isset($r['error'])) {
            return back()->with('message', 'Try Again Some Technical Error!');
        }

        // async success → webhook updates user’s affidavit when ready
        return back()->with('message', 'योगदान के लिए धन्यवाद ! आपका शपथ पत्र तैयार किया जा रहा है।');
    }
}
