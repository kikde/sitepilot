<?php

namespace Dapunabi\Billing\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'billing_plans';
    protected $fillable = [
        'code','name','interval','price','currency','trial_days','seat_limit','active'
    ];
}
