<?php

namespace Modules\Partner\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use App\Models\User;
use View;

use Modules\Partner\Entities\Partner;

class PartnerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $setting = Setting::first();
        View::share(['setting'=>$setting]);
        // $this->middleware('permission:partner-list|partner-create|partner-edit|partner-delete',['only'=> 'index']);
        // $this->middleware('permission:partner-create',['only'=> ['store']]);
        // $this->middleware('permission:partner-edit',['only'=> ['update']]);
        // $this->middleware('permission:partner-delete',['only'=> ['delete','bulk_action']]);
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
       
        $all_partners = Partner::latest()->get();
        // return view('backend.pages.partners',compact('all_partners'));
        
        return view('partner::index', compact('all_partners'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('partner::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'url' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $data = [
            'url' => purify_html($request->url),
            'image' => $request->image,
        ];

        Partner::create($data);

        return redirect()->back()->with('message','Client Added Succesfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('partner::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('partner::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'url' => 'required|string',
            'image' => 'nullable|string',
        ]);

        Partner::findOrFail($request->id)->update([
            'url' => purify_html($request->url),
            'image' => $request->image,
        ]);

        return redirect()->back()->with([
            'msg' => __('Client Update Success...'),
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        Partner::findOrFail($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Client Delete Success...'),
            'type' => 'danger'
        ]);
    }


    public function bulk_action(Request $request){

        Partner::whereIn('id',$request->ids)->delete();
        return redirect()->back()->with([
            'msg' => __('Client Delete Success...'),
            'type' => 'danger'
        ]);
    }
}
