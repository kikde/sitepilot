<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuccessStory extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\SuccessStoryFactory::new();
    }

    // public function category(){

    //     return $this->belongsTo(SuccessStoryCategory::class);

    // }


    public function category(){
        return $this->belongsTo(SuccessStoryCategory::class,'success_story_category_id');
    }

    public function categories() { 

        return $this->belongsToMany(SuccessStoryCategory::class); 
    }
}
