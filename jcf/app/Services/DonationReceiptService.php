<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Page\Entities\Donation;
use Modules\Setting\Entities\Setting;

class DonationReceiptService
{
    public function createAndStorePdf(Donation $donation): Donation
    {
        if (!$donation->relationLoaded('donor')) {
            $donation->load('donor');
        }

        // 1) Generate a receipt number if missing
        if (!$donation->receipt_no) {
            // e.g. VIH/2025/0000123
            $prefix = 'HHF/'.now()->format('Y').'/';
            $serial = str_pad((string)($donation->id), 7, '0', STR_PAD_LEFT);
            $donation->receipt_no = $prefix.$serial;
        }

        // 2) Build PDF
        $setting = Setting::first();
        $data = [
            'setting'  => $setting,
            'donation' => $donation,
            'donor'    => $donation->donor,
            'amount'   => round($donation->amount_paise / 100, 2),
            'date'     => now()->format('d M Y'),
        ];

        $pdf = Pdf::loadView('page::donations.receipt-pdf', $data)->setPaper('a4');

        // 3) Store in /storage/app/public/receipts/YYYY/receipt.pdf
        $dir  = 'receipts/'.now()->format('Y');
        $name = Str::slug($donation->receipt_no).'.pdf';
        $path = $dir.'/'.$name;

        Storage::disk('public')->put($path, $pdf->output());
        $donation->receipt_pdf_path = $path;
        $donation->save();

        return $donation;
    }
}