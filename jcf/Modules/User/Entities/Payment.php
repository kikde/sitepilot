<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    // allow the fields you write in controllers/webhooks
    protected $fillable = [
         'user_id',
        'screenshot',
        'payment_rec',
        'razorpay_order_id',
        'razorpay_payment_id',
        'status',
        'amount',
        'currency',
        'method',
        'note',
        'is_verified',
        'verified_at',
    ];

    // if you prefer to allow everything:
    // protected $guarded = [];

    public function user()
    {
        // your users live in the same module
        return $this->belongsTo(\Modules\User\Entities\User::class, 'user_id');
    }
}
