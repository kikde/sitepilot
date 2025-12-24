<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\TicketDepartment;
use Hash;
use View;

class TicketDepartmentController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        $setting = Setting::first();
         View::share(['setting'=>$setting]);
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $all_category = TicketDepartment::all();
        return view('user::support-ticket.department.support-ticket-category')->with([
            'all_category' => $all_category
        ]);
        // return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
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
            'name' => 'required|string|max:191|unique:support_ticket_departments',
            'status' => 'required|string|max:191'
        ]);

        TicketDepartment::create([
            'name'=> $request->name,
            'status'=> $request->status,
        ]);

        return redirect()->back()->with('message', "Added Successfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
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
            'name' => 'required|string|max:191|unique:support_ticket_departments,id,'.$request->id,
            'status' => 'required|string|max:191'
        ]);

        TicketDepartment::find($request->id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'lang' => $request->lang,
        ]);

        return redirect()->back()->with('message', "Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        TicketDepartment::find($id)->delete();
        return redirect()->back()->with('message', "Deleted Successfully");
    }

    public function bulk_action(Request $request){
        TicketDepartment::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
