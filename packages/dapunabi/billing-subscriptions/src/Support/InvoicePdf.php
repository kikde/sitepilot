<?php

namespace Dapunabi\Billing\Support;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use Dapunabi\Billing\Models\Invoice;

class InvoicePdf
{
    public static function generateAndStore(Invoice $invoice, string $tenantSlug): string
    {
        $number = $invoice->number ?? ('INV-'.$invoice->id);
        $dir = 'invoices/'.$tenantSlug;
        $relPath = $dir.'/'.$number.'.pdf';

        if (Storage::disk('local')->exists($relPath)) {
            return $relPath;
        }

        $html = view('billing::billing.invoice', [
            'invoice' => $invoice,
            'tenant' => self::resolveTenant(),
        ])->render();

        $dompdf = new Dompdf([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        Storage::disk('local')->makeDirectory($dir);
        Storage::disk('local')->put($relPath, $dompdf->output());

        return $relPath;
    }

    protected static function resolveTenant(): ?object
    {
        if (function_exists('currentTenant')) {
            return currentTenant();
        }
        return null;
    }
}

