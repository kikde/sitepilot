<?php

namespace App\Listeners;
use App\Mail\BasicMail;
use Modules\User\Entities\SupportTicket;
use App\Events\SupportMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SupportSendMailToUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function handle($event)
    {
        $ticket_info = $event->message;
        if ($ticket_info->notify === 'on' && $ticket_info->type === 'admin'){
            //subject
            $subject = __('your have a new message in ticket').' #'.$ticket_info->id;
            $ticket_details = SupportTicket::findOrFail($ticket_info->support_ticket_id);
            $user_email = optional($ticket_details->user)->email ?? '';
            $message = '<p>'.__('Hello').'<br>';
            $message .= 'you have a new message in ticket no'.' #'.$ticket_info->id.'. ';
            // $message .= '<div class="btn-wrap"><a class="anchor-btn" href="'.route('user.dashboard.support.ticket.view',$ticket_info->support_ticket_id).'">'.__('check messages').'</a></div>';
            $message .= '</p>';

            $data =  [
                'message' => $message,
                'subject' => $subject
            ];
          


            //  Mail::to('kikde.sara@gmail.com')->send(new BasicMail($data));
            if (!empty('kikde.sara@gmail.com')){
                try {
                    Mail::to('kikde.sara@gmail.com')->send(new BasicMail($data));
                }catch (\Exception $e){
                    //show error message
                }
            }
        }
    }
  
}
