<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_holder',
        'bank_name',
        'account_number',
        'account_ifsc',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\BankFactory::new();
    }
}
