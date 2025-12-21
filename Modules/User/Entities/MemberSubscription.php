<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberSubscription extends Model
{
    use HasFactory;

    protected $table = 'member_subscriptions';

    protected $fillable = [
        'user_id',

        // Razorpay subscription details
        'razorpay_subscription_id',   // e.g. sub_XXXX
        'razorpay_plan_id',           // e.g. plan_XXXX (if you use plans)

        // billing info
        'amount_paise',               // integer amount in paise
        'currency',                   // 'INR'
        'interval',                   // e.g. 'monthly', 'yearly'
        'status',                     // created / active / paused / cancelled / completed

        // lifecycle dates
        'start_at',
        'end_at',
        'next_charge_at',

        // anything extra from Razorpay (JSON)
        'meta',
    ];

    protected $casts = [
        'amount_paise'  => 'integer',
        'start_at'      => 'datetime',
        'end_at'        => 'datetime',
        'next_charge_at'=> 'datetime',
        'meta'          => 'array',
    ];

    /**
     * Subscription belongs to a member (user).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Is subscription active?
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Helper: amount in rupees.
     */
    public function amountInRupees(): ?float
    {
        return $this->amount_paise !== null
            ? $this->amount_paise / 100
            : null;
    }
}
