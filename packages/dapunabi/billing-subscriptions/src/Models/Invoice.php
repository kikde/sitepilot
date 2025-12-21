<?php

namespace Dapunabi\Billing\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'billing_invoices';
    protected $fillable = [
        'tenant_id','number','amount','currency','status','due_date','paid_at'
    ];
}

