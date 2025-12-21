<?php

namespace Modules\User\Entities;
use Modules\User\Entities\Payment;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

      protected $fillable = [
     
        'referrer_id',
        'referral_code',
       
    ];

    // keep your $fillable, $casts, etc. if you have them

    /**
     * All payments for this user.
     */
    public function paymentsx()
    {
        // If your Payment model lives in Modules\User\Entities too, use Payment::class.
        // If it lives in App\Models\Payment, use \App\Models\Payment::class instead.
        return $this->hasMany(\App\Models\Payment::class, 'user_id');
        // return $this->hasMany(Payment::class, 'user_id'); // <— use this line if Payment is moved into Entities
    }

    /**
     * Latest payment row (by highest id).
     * Use latestOfMany('created_at') if you prefer timestamp ordering.
     */
    public function latestPaymentx()
    {
        return $this->hasOne(\App\Models\Payment::class, 'user_id')->latestOfMany('id');
        // return $this->hasOne(Payment::class, 'user_id')->latestOfMany('id'); // if Payment is in Entities
    }

    /**
     * Expose latest receipt path as virtual attribute: $user->latest_payment_rec
     */
    protected $appends = ['latest_payment_rec'];

    public function getLatestPaymentRecAttribute()
    {
        return optional($this->latestPayment)->payment_rec; // relative path like "apishot/results/xxx.pdf"
    }
    

 public function payments()
{
    return $this->hasMany(\Modules\User\Entities\Payment::class, 'user_id');
}

// handy accessor for latest payment
public function latestPayment()
{
    return $this->hasOne(\Modules\User\Entities\Payment::class, 'user_id')->latestOfMany();
}


    public function referrer()
    {
        return $this->belongsTo(self::class, 'referrer_id');
    }

    public function referrals()
    {
        return $this->hasMany(self::class, 'referrer_id');
    }

    /**
     * Generate a unique referral code.
     */
    public static function generateReferralCode(int $length = 8): string
    {
        do {
            $code = Str::upper(Str::random($length));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Automatically set referral_code when creating (if empty).
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $user) {
            if (empty($user->referral_code)) {
                $user->referral_code = self::generateReferralCode();
            }
        });
    }


    public function getReferralLinkAttribute(): ?string
{
    return $this->referral_code ? url('/member-registration?ref='.$this->referral_code) : null;
}

}
