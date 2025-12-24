<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Modules\Member\Entities\Member;

// use App\Models\User as Member;                 // Members are Users (role = 2)
use Modules\Setting\Entities\Setting;          // Settings module
use Modules\Member\Entities\Category;          // Member categories (if used)

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;           // For simple HTTP calls (Laravel wrapper)
use Intervention\Image\Facades\Image;          // Image handling

class MemberController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth'); 
        $setting = Setting::query()->first();
        View::share('setting', $setting);
    }

    public function index()
    { $categories = Category::query()->pluck('name', 'id');
      $members    = Member::latest()->paginate(10);
      return view('member::members.index', compact('members', 'categories'));  }
       
    public function create(): Renderable
    {   $categories = Category::query()->get();
        $states     = Config::get('constants.state');
        return view('member::members.add', compact('categories', 'states'));  }
 
    public function getcity(Request $request)
    {
        $states = Config::get('constants.state', []);
        $cities = $states[$request->sid] ?? [];
        $html = '<option value="">Select City</option>';
        foreach ($cities as $city) {
            $html .= '<option value="' . e($city) . '">' . e($city) . '</option>';
        }
        return $html;
    }
  
    public function store(Request $request)
    {
        // Basic validation (extend as needed)
        $request->validate([
            'name'   => 'required|string|max:190',
            'mobile' => 'nullable|string|max:20|unique:users,mobile',
            'email'  => 'nullable|email|max:190|unique:users,email',
            'images'   => 'nullable|image|max:2048',
            'document' => 'nullable|mimes:pdf,jpg,jpeg,png|max:4096',
            'uploadfile'=> 'nullable|file|max:5120',
        ]);

        $member = new Member();
        $member->user_id     = Auth::id();
        $member->role        = 2; // ensure role is member
        $member->name        = $request->name;
        $member->gender      = $request->gender;
        $member->dob         = $request->dob;
        $member->father_name = $request->father_name;
        $member->profession  = $request->profession;
        $member->bloodgroup  = $request->bloodgroup;
        $member->state       = $request->state;
        $member->city        = $request->city;
        $member->mobile      = $request->mobile;
        $member->email       = $request->email;
        $member->address     = $request->address;
        $member->pincode     = $request->pincode;
        $member->idtype      = $request->idtype;
        $member->rating      = $request->rating;
        $member->page_title  = $request->page_title;
        $member->page_keyword= $request->page_keyword;
        $member->slug        = $request->slug;
        $member->status      = $request->status;

        // Profile image (stores processed image into /public/backend/uploads)
        if ($request->hasFile('images')) {
            $img      = $request->file('images');
            $filename = str_replace(' ', '_', $request->name) . '_img_' . time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save(public_path('backend/uploads/' . $filename));
            $member->images = $filename;
        }

        // Document upload (kept in same uploads folder)
        if ($request->hasFile('document')) {
            $doc       = $request->file('document');
            $docname   = str_replace(' ', '_', $request->name) . '_doc_' . time() . '.' . $doc->getClientOriginalExtension();
            $doc->move(public_path('backend/uploads'), $docname);
            $member->document = $docname;
        }

        // Extra file (uploadfile) stored under /public/backend/pdf
        if ($request->hasFile('uploadfile')) {
            $this->storeUploadFile($request, $member);
        }

        $member->save();

        return redirect()->route('members.index')->with('message', 'Member added successfully');
    }



 public function edit(Member $member)   
{
    $categories = Category::pluck('name','id'); 
    $states = Config::get('constants.states', []);
    return view('member::members.edit', compact('member', 'categories','states'));
}


 
    public function update(Request $request, $id)
    {
        $member = Member::query()->findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:190',
            'mobile' => 'nullable|string|max:20|unique:users,mobile,' . $member->id,
            'email'  => 'nullable|email|max:190|unique:users,email,' . $member->id,
            'images'   => 'nullable|image|max:2048',
            'document' => 'nullable|mimes:pdf,jpg,jpeg,png|max:4096',
            'uploadfile'=> 'nullable|file|max:5120',
        ]);

        $member->user_id     = Auth::id();
        $member->name        = $request->name;
        $member->gender      = $request->gender;
        $member->dob         = $request->dob;
        $member->father_name = $request->father_name;
        $member->profession  = $request->profession;
        $member->bloodgroup  = $request->bloodgroup;
        $member->state       = $request->state;
        $member->city        = $request->city;
        $member->mobile      = $request->mobile;
        $member->email       = $request->email;
        $member->address     = $request->address;
        $member->pincode     = $request->pincode;
        $member->idtype      = $request->idtype;
        $member->rating      = $request->rating;
        $member->page_title  = $request->page_title;
        $member->page_keyword= $request->page_keyword;
        $member->slug        = $request->slug;
        $member->status      = $request->status;

        if ($request->hasFile('images')) {
            $img      = $request->file('images');
            $filename = str_replace(' ', '_', $request->name) . '_img_' . time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save(public_path('backend/uploads/' . $filename));
            $member->images = $filename;
        }

        if ($request->hasFile('document')) {
            $doc       = $request->file('document');
            $docname   = str_replace(' ', '_', $request->name) . '_doc_' . time() . '.' . $doc->getClientOriginalExtension();
            $doc->move(public_path('backend/uploads'), $docname);
            $member->document = $docname;
        }

        if ($request->hasFile('uploadfile')) {
            $this->storeUploadFile($request, $member);
        }

        $member->save();

        return redirect()->route('members.index')->with('message', 'Member updated successfully');
    }

    /**
     * DELETE /members/{member}
     * Soft/Hard delete (depends on your User model).
     */
    public function destroy($id)
    {
        $member = Member::query()->findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('message', 'Member deleted successfully');
    }

    /**
     * Helper to store the extra uploaded file as PDF/any into /public/backend/pdf
     */
    protected function storeUploadFile(Request $request, Member $member): void
    {
        $file     = $request->file('uploadfile');
        $filename = str_replace(' ', '_', $request->name) . '_file_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('backend/pdf'), $filename);
        $member->uploadfile = $filename;
    }

    // --------------------------------------------------------------------------------
    // Custom actions: Activate / Deactivate, and ID Card
    // --------------------------------------------------------------------------------

    /**
     * GET /member/{id}/{type}/active
     * Calls SNAP API to create screenshot, marks member active.
     */
    public function memberActive($id)
    {
        $member   = Member::query()->findOrFail($id);
        $filename = str_replace(' ', '', $member->name) . time() . '.png';

        // Replace with your real card URL (currently placeholder)
        $targetUrl = url('membercard/' . $member->id);

        // Build request to your SNAP service
        $url = rtrim(env('SNAP_URL'), '/') .
               '?url=' . urlencode($targetUrl) .
               '&sizex=600&sizey=660&fname=' . urlencode(env('APP_NAME')) .
               '&filename=' . urlencode($filename);

        $response = Http::withToken(env('SNAP_TOKEN'))
                        ->acceptJson()
                        ->post($url);

        if (!$response->ok()) {
            return back()->with('message', 'SNAP API failed');
        }

        $data = $response->json();
        if (!isset($data['url'])) {
            return back()->with('message', 'SNAP response missing URL');
        }

        // Save file to storage/app/public (disk "public" must be configured)
        $saved = Storage::disk('public')->put($filename, file_get_contents($data['url']));

        if ($saved) {
            $member->status     = '1';
            $member->screenshot = $filename;
            $member->save();

            return back()->with('message', 'Activated');
        }

        return back()->with('message', 'Member screenshot not saved');
    }

    /**
     * GET /member/{id}/{type}/deactive
     * Mark member inactive.
     */
    public function memberDeactive($id)
    {
        $member         = Member::query()->findOrFail($id);
        $member->status = '0';
        $member->save();

        return back()->with('message', 'Deactivated');
    }

    /**
     * GET /membercard/{id}
     * Render/return ID card page (fill as per your blade).
     */
    public function membersCard($id)
    {
        // Implement your ID card view here
        // return view('member::members.card', ['member' => Member::findOrFail($id)]);
        abort(404); // placeholder until you wire the blade
    }
}
