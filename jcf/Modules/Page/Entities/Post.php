<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'posts';
    
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\PostFactory::new();
    }
}
