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
        $this->donation->loadMissing('donor');
        try {
            $setting = \Modules\Setting\Entities\Setting::query()->first();
        } catch (\Throwable $e) {
            $setting = null;
        }
        $donation = $this->donation;
        $donor    = $donation->donor;
        $amount   = is_numeric($donation->amount_paise ?? null)
            ? ((float) $donation->amount_paise) / 100
            : ((float) ($donation->amount ?? 0));

        $mail = $this->from(config('mail.from.address'), config('mail.from.name'))\n                     ->subject('Donation Receipt '.\->receipt_no)\n                     ->view('page::donations.receipt-email', compact('donation','setting','donor','amount'));

        if ($donation->receipt_pdf_path && Storage::disk('public')->exists($donation->receipt_pdf_path)) {
            $mail->attachFromStorageDisk('public', $donation->receipt_pdf_path, 'receipt-'.$donation->receipt_no.'.pdf');
        }

        return $mail;
    }
}