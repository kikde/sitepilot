<?php

namespace Dapunabi\Billing\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionSeat extends Model
{
    protected $table = 'billing_subscription_seats';
    protected $fillable = [
        'subscription_id','user_id','role'
    ];
}

