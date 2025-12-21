<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'images',
    ];

    // protected $casts = [
    //     'images' => 'array',
    // ];

    protected static function newFactory()
    {
        return \Modules\Member\Database\factories\MemberFactory::new();
    }

    // Many-to-many: default pivot table `category_member`
    // If your pivot is named differently, specify ->withTimestamps()->using() or ->withPivot(), and `->table('category_member')` via intermediate model.
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function thumbImages()
    {
        return $this->hasMany(Thumbimage::class);
    }
}
