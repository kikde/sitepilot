<?php

namespace App\Services;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View as ViewFacade;
use Modules\Page\Entities\Donation;

class DonationReceiptService
{
    /**
     * Generate a PDF receipt for a paid donation and store it on the public disk.
     * Also sets a receipt number if missing.
     */
    public function createAndStorePdf(Donation $donation): void
    {
        if (! $donation->receipt_no) {
            $donation->receipt_no = $this->makeReceiptNo($donation->id);
        }

        // Build view data
        $donation->loadMissing('donor');
        try {
            $setting = \Modules\Setting\Entities\Setting::query()->first();
        } catch (\Throwable $e) {
            $setting = null;
        }
        $donor  = $donation->donor;
        $amount = is_numeric($donation->amount_paise ?? null)
            ? ((float) $donation->amount_paise) / 100
            : ((float) ($donation->amount ?? 0));
        $date   = optional($donation->created_at)->format('d-m-Y') ?? date('d-m-Y');

        $html = ViewFacade::make('page::donations.receipt-pdf', compact('donation','setting','donor','amount','date'))
            ->render();

        // Render PDF via Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();

        $folder = 'receipts/' . date('Y/m');
        $filename = 'receipt-' . $donation->receipt_no . '.pdf';
        $path = trim($folder . '/' . $filename, '/');

        Storage::disk('public')->put($path, $output);

        $donation->receipt_pdf_path = $path;
        $donation->save();
    }

    protected function makeReceiptNo(int $id): string
    {
        return 'DN' . date('Ymd') . '-' . str_pad((string) $id, 6, '0', STR_PAD_LEFT);
    }
}