<?php

namespace Dapunabi\UiTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'ui_blocks';
    protected $fillable = [
        'tenant_id','code','name','schema','defaults','active','version'
    ];
    protected $casts = [
        'schema' => 'array',
        'defaults' => 'array',
        'active' => 'boolean',
    ];
}
