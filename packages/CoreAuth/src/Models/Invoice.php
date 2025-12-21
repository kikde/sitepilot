<?php

namespace Dapunjabi\CoreAuth\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'coreauth_invoices';
    protected $fillable = [
        'tenant_id','number','amount','currency','status','due_date','paid_at'
    ];
}

