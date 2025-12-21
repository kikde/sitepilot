<?php

namespace Modules\Partner\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';
    protected $fillable = ['url','image'];

    // protected static function newFactory()
    // {
    //     return \Modules\Partner\Database\factories\PartnerFactory::new();
    // }

    public function partners(){

        return $this->belongsTo(MediaUpload::class);
    }
}
