<?php

// app/Mail/DonationReceiptMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Page\Entities\Donation;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Donation $donation) {}

    public function build()
    {
        $donor   = $this->donation->donor;
        $amount  = round($this->donation->amount_paise / 100, 2);

        $mail = $this->subject('Thank you! Your donation receipt - '.$this->donation->receipt_no)
            ->markdown('page::donations.receipt-email', [
                'donation' => $this->donation,
                'donor'    => $donor,
                'amount'   => $amount,
            ]);

        // Attach PDF if present
        if ($this->donation->receipt_pdf_path) {
            $mail->attach(storage_path('app/public/'.$this->donation->receipt_pdf_path));
        }

        return $mail;
    }
}
