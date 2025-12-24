<?php

namespace Modules\Member\Entities;
use Modules\Member\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thumbimage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'product_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ThumbimageFactory::new();
    }

    
    public function products(){
        return $this->belongsTo(Product::class);
     }
}
