<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintThanksMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailform;

    public function __construct($mailform)
    {
        $this->mailform = $mailform;
    }

    public function build()
    {
        return $this->subject('We received your complaint')
                    ->view('emails.complaint-thanks')
                    ->with([
                        'mailform' => $this->mailform,
                    ]);
    }
}
