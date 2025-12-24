<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    // implements MustVerifyEmail
    protected $dates = ['deleted_at'];

    public function authorize()
    {
        return true;
        // return Auth::check();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'useractive',
        'valid_upto',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function payments(){

        return $this->belongsTo(Payment::class, 'user_id');
    }

     public function referrer()  // the sponsor/upline
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

     public function referrals() // direct downline
    {
        return $this->hasMany(User::class, 'referrer_id');
    }
    
    public static function generateReferralCode(): string
    {
            do {
                $code = Str::upper(Str::random(8));
            } while (self::where('referral_code', $code)->exists());

            return $code;
    }

}
