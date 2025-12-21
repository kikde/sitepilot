<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thumbimage extends Model
{
    use HasFactory;

    protected $table = 'thumbimages';

    protected $fillable = [
        'image',
        'product_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Member\Database\factories\ThumbimageFactory::new();
    }
}
