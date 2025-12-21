<?php

namespace Dapunabi\UiTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class Shortcode extends Model
{
    protected $table = 'ui_shortcodes';
    protected $fillable = [
        'code','handler','description','schema','active'
    ];
    protected $casts = [
        'schema' => 'array',
        'active' => 'boolean',
    ];
}
