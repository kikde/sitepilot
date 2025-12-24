<?php

namespace Modules\Gallery\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gallery\Entities\Gallery;
use Modules\Setting\Entities\Setting;
use Image;
use Auth;
use View;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $setting = Setting::first();
        View::share(['setting' => $setting]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $site = $request->get('share_site', 'gallery');

    $gall = Gallery::query()
        ->where('type', 'photo')
        // If you only want strict 'gallery'
        ->when($site === 'gallery', fn($q) => $q->where('share_site', 'gallery'))
        // For other tabs like certificate, project etc.
        ->when($site !== 'gallery', fn($q) => $q->where('share_site', $site))
        ->simplePaginate(6)
        ->appends($request->query());  // keep ?share_site=... on pagination links

    return view('gallery::photo.index', [
        'gall'       => $gall,
        'share_site' => $site,
    ]);
    }
  
    
     
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        // Current section so form can put it in a hidden input
        $share_site = $request->share_site ?? 'gallery';

        return view('gallery::photo.add', compact('share_site'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $gall = new Gallery;

        if ($request->hasFile('images')) {
            $postimage = $request->file('images');
            $photoname = $request->name . '_prd_' . time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->resize(600, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/backend/gallery/photo/' . $photoname));

            $gall->images = $photoname;
        }

        if ($request->hasFile('video')) {
            $this->Uploadfile($request, $gall);
        }

        $gall->alt_tag      = $request->alt_tag;
        $gall->user_id      = Auth::user()->id;
        $gall->title        = $request->title;
        $gall->description  = $request->description;
        $gall->type         = $request->type;
        $gall->video_option = $request->video_option;
        $gall->share_site   = $request->share_site;   // section (gallery/certificate/project/...)
        $gall->link         = $request->link;
        $gall->status       = $request->status;

        $gall->save();

        $section = $request->share_site ?? 'gallery';

        return redirect('/photogallery?share_site=' . $section)
            ->with('message', "Added Sucessfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $gall = Gallery::find($id);
        return view('gallery::photo.edit', compact('gall'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $gall = Gallery::find($id);

        // prefer query param, fallback to DB value, then default
        $share_site = $request->share_site ?? $gall->share_site ?? 'gallery';

        return view('gallery::photo.edit', compact('gall', 'share_site'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $gall = Gallery::where('id', $id)->first();

        if ($request->hasFile('images')) {
            $postimage = $request->file('images');
            $photoname = $request->name . '_prd_' . time() . '.' . $postimage->getClientOriginalExtension();
            Image::make($postimage)->resize(600, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/backend/gallery/photo/' . $photoname));

            $gall->images = $photoname;
        }

        if ($request->hasFile('video')) {
            $this->Uploadfile($request, $gall);
        }

        $gall->alt_tag      = $request->alt_tag;
        $gall->user_id      = Auth::user()->id;
        $gall->title        = $request->title;
        $gall->description  = $request->description;
        $gall->type         = $request->type;
        $gall->video_option = $request->video_option;
        $gall->share_site   = $request->share_site;
        $gall->link         = $request->link;
        $gall->status       = $request->status;

        $gall->save();

        $section = $request->share_site ?? 'gallery';

        return redirect('/photogallery?share_site=' . $section)
            ->with('message', "updated Sucessfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $gall = Gallery::find($id);
        $gall->delete();
        return redirect()->back()->with('message', "deleted Sucessfully");
    }

    //==================================================Video Gallery=============================================//

    public function indexVideo(Request $request)
    {
        $query = Gallery::where('type', 'video');

        if ($request->filled('share_site')) {
            $query->where('share_site', $request->share_site);
        }

        $gall = $query->simplePaginate(6);

        return view('gallery::video.index', [
            'gall'       => $gall,
            'share_site' => $request->share_site ?? null,
        ]);
    }

    public function videoCreate(Request $request)
    {
        $share_site = $request->share_site ?? 'gallery';
        return view('gallery::video.add', compact('share_site'));
    }

    public function Uploadfile($request, $gall)
    {
        $postimage = $request->file('video');
        $filename = $request->name . '_prd_' . time() . '.' . $postimage->getClientOriginalExtension();
        $postimage->move(public_path('/backend/gallery/video/'), $filename);
        $gall->video = $filename;
    }
    
        public function videoEdit(Request $request, $id)
    {

        $gall = Gallery::find($id);
        $share_site = $request->share_site ?? 'video';
        return view('gallery::video.edit', compact('gall','share_site'));
    }
}
