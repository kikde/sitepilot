<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailform; 

    /**
     * @param \Illuminate\Http\Request $mailform
     */
    public function __construct($mailform)
    {
        $this->mailform = $mailform;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // base email with view
        $email = $this->subject('Customer Request')
                      ->view('welcome')   // <- make sure file is resources/views/Mail.blade.php
                      ->with([
                          'mailform' => $this->mailform,
                      ]);

        // attach Document 1 if present
        if ($this->mailform->hasFile('file1')) {
            $file1 = $this->mailform->file('file1');

            $email->attach($file1->getRealPath(), [
                'as'   => $file1->getClientOriginalName(),
                'mime' => $file1->getMimeType(),
            ]);
        }

        // attach Document 2 if present
        if ($this->mailform->hasFile('file2')) {
            $file2 = $this->mailform->file('file2');

            $email->attach($file2->getRealPath(), [
                'as'   => $file2->getClientOriginalName(),
                'mime' => $file2->getMimeType(),
            ]);
        }

        return $email;
    }
}
