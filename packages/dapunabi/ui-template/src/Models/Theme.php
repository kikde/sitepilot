<?php

namespace Dapunabi\UiTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'ui_themes';
    protected $fillable = [
        'tenant_id','tokens','settings'
    ];
    protected $casts = [
        'tokens' => 'array',
        'settings' => 'array',
    ];
}
