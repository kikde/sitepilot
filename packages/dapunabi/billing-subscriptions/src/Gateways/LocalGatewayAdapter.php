<?php

namespace Dapunabi\Billing\Gateways;

use Dapunabi\Billing\Models\Invoice;
use Dapunabi\Billing\Models\Plan;
use Illuminate\Support\Str;

class LocalGatewayAdapter
{
    public function createInvoice(int $tenantId, Plan $plan): Invoice
    {
        $number = $this->generateNumber();

        // For the stub, we also set plan_code as a dynamic attribute on invoice for confirm step
        $invoice = new Invoice();
        $invoice->tenant_id = $tenantId;
        $invoice->number = $number;
        $invoice->amount = $plan->price;
        $invoice->currency = config('billing.currency', 'USD');
        $invoice->status = 'due';
        // Store plan_code as a dynamic property for retrieval in confirm (no dedicated column in Phase 1)
        $invoice->plan_code = $plan->code; // not persisted by Eloquent unless column exists but accessible in memory
        $invoice->save();

        return $invoice;
    }

    protected function generateNumber(): string
    {
        return 'INV-'.date('Ymd').'-'.str_pad((string) (Invoice::max('id') + 1), 4, '0', STR_PAD_LEFT);
    }
}

