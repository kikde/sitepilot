<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donor extends Model
{
    use HasFactory;
       protected $table = 'donors'; // 
       protected $fillable = [
        'name','email','mobile','pan_no','state','city','address','pincode'
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class, 'donor_id');
    }
    
    // (optional)
    public function latestDonation()
    {
        return $this->hasOne(Donation::class, 'donor_id')->latestOfMany();
    }

    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\DonarFactory::new();
    }
}
