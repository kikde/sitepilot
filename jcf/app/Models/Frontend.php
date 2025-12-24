<?php

namespace App\Models;
use Modules\Product\Entities\Thumbimage;
use Modules\Product\Entities\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frontend extends Model
{
    use HasFactory;

    public function thumbimages(){
        return $this->hasMany(Thumbimage::class);
    }

    public function categories(){

        return $this->belongsTo(Category::class, 'category_id');
    }

    public function category(){
        return $this->belongsTo(SuccessStoryCategory::class,'success_story_category_id');
    }

}
