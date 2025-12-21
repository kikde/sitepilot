<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationSubscription extends Model
{
    use HasFactory;

    protected $table = 'donation_subscriptions';

    protected $fillable = [
        'donor_id',
        'razorpay_subscription_id',
        'plan_id',
        'status',
        'amount_paise',
        'interval',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * A subscription belongs to a donor.
     */
    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id');
    }

    /**
     * Helper: is subscription active?
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Helper: formatted amount in rupees.
     */
    public function amountInRupees(): ?float
    {
        return $this->amount_paise !== null
            ? $this->amount_paise / 100
            : null;
    }
}
