<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
  'donor_id','campaign','amount_paise','currency','status',
  'razorpay_order_id','razorpay_payment_id','razorpay_signature','meta',
  'receipt_no','receipt_pdf_path','emailed_at',
];
protected $casts = [
  'meta' => 'array',
  'emailed_at' => 'datetime',
];
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\DonationFactory::new();
    }


    public function donor()
{
    return $this->belongsTo(Donor::class, 'donor_id'); // explicit key (safe)
}
}
