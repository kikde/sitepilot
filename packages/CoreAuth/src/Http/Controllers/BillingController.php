<?php

namespace Dapunjabi\CoreAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Dapunjabi\CoreAuth\Support\TenantManager;
use Dapunjabi\CoreAuth\Models\Invoice;

class BillingController extends Controller
{
    public function index(TenantManager $tm)
    {
        if (!Auth::check()) return redirect()->route('login');
        $tenant = $tm->current();
        if (!$tenant) return redirect('/tenant/select');
        $invoices = Invoice::query()->where('tenant_id', $tenant->id)->orderByDesc('created_at')->get();
        return view('coreauth::billing.index', compact('tenant','invoices'));
    }

    public function pay(Request $request, TenantManager $tm, int $id)
    {
        if (!Auth::check()) return redirect()->route('login');
        $tenant = $tm->current();
        if (!$tenant) return redirect('/tenant/select');
        $invoice = Invoice::query()->where('tenant_id', $tenant->id)->findOrFail($id);
        if ($invoice->status === 'paid') {
            return back()->with('status', 'Invoice already paid');
        }
        DB::transaction(function () use ($invoice, $tenant) {
            $invoice->status = 'paid';
            $invoice->paid_at = now();
            $invoice->save();
            // If all invoices paid, mark tenant active
            $dueCount = Invoice::query()->where('tenant_id', $tenant->id)->where('status', 'due')->count();
            if ($dueCount === 0) {
                $tenant->license_status = 'active';
                $tenant->save();
            }
        });
        return back()->with('status', 'Payment received');
    }
}

