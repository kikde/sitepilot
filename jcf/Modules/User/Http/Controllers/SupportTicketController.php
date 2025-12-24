<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\SupportTicket;
use Modules\User\Entities\TicketDepartment;
use Modules\User\Entities\SupportTicketMessage;
use App\Events\SupportMessage;
use App\Models\User;
use Hash;
use View;
use Auth;

class SupportTicketController extends Controller
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
        $id = Auth::user()->id;
        if(Auth::user()->role ==2 or Auth::user()->status == 1){
            
           $all_tickets = SupportTicket::where('user_id',$id)->get();
           return view('user::support-ticket.index', compact('all_tickets'));
        }
        $all_tickets = SupportTicket::orderBy('id','desc')->get();
        // return $all_tickets;
        return view('user::support-ticket.index', compact('all_tickets'));
       
        // return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $all_users = User::where('role', 2)->get();
        // return $all_users;
        $all_departments = TicketDepartment::where(['status' => 'publish'])->get();
        return view('user::support-ticket.add',compact('all_users', 'all_departments'));
       
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
            'title' => 'required|string|max:191',
            'subject' => 'required|string|max:191',
            'priority' => 'required|string|max:191',
            'description' => 'required|string',
            'department_id' => 'required|string',
        ],[
            'title.required' => __('title required'),
            'subject.required' =>  __('subject required'),
            'priority.required' =>  __('priority required'),
            'description.required' => __('description required'),
            'department_id.required' => __('departments required'),
        ]);
        SupportTicket::create([
            'title' => $request->title,
            'via' => 'admin',
            'operating_system' => null,
            'user_agent' => null,
            'description' => $request->description,
            'subject' => $request->subject,
            'status' => 'open',
            'priority' => $request->priority,
            'user_id' => $request->user_id, 
            'department_id' => $request->department_id,
            'admin_id' => Auth::user()->id
        ]);
        // $msg =  __('new ticket created successfully');
        return redirect('/support-tickets')->back()->with('message', "new ticket created successfully");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $ticket_details = SupportTicket::findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get();
        $q = $request->q ?? '';
        return view('user::support-ticket.edit')->with(['ticket_details' => $ticket_details,'all_messages' => $all_messages,'q' => $q]);
      
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
       //
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
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        SupportTicket::findOrFail($id)->delete();
        return back()->with('message', "ticket Deleted successfully");
    }

    public function priority_change(Request $request){
        $this->validate($request,[
            'priority' => 'required|string|max:191'
        ]);
        SupportTicket::findOrFail($request->id)->update([
            'priority' => $request->priority,
        ]);
        return 'ok';
    }
    public function status_change(Request $request){
        $this->validate($request,[
            'status' => 'required|string|max:191'
        ]);
        SupportTicket::findOrFail($request->id)->update([
            'status' => $request->status,
        ]);
        return 'ok';
    }


    public function bulk_action(Request $request){
        $all = SupportTicket::find($request->ids);
 
        foreach($all as $item){
            $item->delete();
        }
         return response()->json('Deleted');
     }


     public function send_message(Request $request){

        $request->validate([
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|mimes:zip',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'admin_id' => Auth::user()->id,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        // return $ticket_info;

        if ($request->hasFile('file')){
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->getClientOriginalExtension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('backend/uploads/ticket',$file_name);
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        //send mail to user
       event(new SupportMessage($ticket_info));

        return back()->with('message',"Message send");
    }
}
