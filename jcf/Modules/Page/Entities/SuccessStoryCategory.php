<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuccessStoryCategory extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\SuccessStoryCategoryFactory::new();
    }

   

    public function products()
    {
         return $this->belongsToMany(SuccessStory::class);
    }
}
