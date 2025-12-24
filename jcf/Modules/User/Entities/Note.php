<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table= 'notes';
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\NoteFactory::new();
    }
}
