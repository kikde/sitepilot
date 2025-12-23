<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $table = 'events_categories';

    protected $fillable = [
        'title',
        'status',
    ];
}

