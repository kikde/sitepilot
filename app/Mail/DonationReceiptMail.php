<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Page\Entities\Donation;
use Illuminate\Support\Facades\Storage;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public Donation $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        $mail = $this->subject('Donation Receipt '.$this->donation->receipt_no)
                     ->view('page::donations.receipt-email', [
                         'donation' => $this->donation,
                     ]);

        if ($this->donation->receipt_pdf_path && Storage::disk('public')->exists($this->donation->receipt_pdf_path)) {
            $mail->attachFromStorageDisk('public', $this->donation->receipt_pdf_path, 'receipt-'.$this->donation->receipt_no.'.pdf');
        }

        return $mail;
    }
}