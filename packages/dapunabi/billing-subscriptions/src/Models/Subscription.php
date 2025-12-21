<?php

namespace Dapunabi\Billing\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'billing_subscriptions';
    protected $fillable = [
        'tenant_id','user_id','plan_code','status','current_period_start','current_period_end','cancel_at_period_end'
    ];
}

