<?php

namespace Dapunabi\UiTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'ui_pages';
    protected $fillable = [
        'tenant_id','title','slug','locale','template_id','data','meta','published'
    ];
    protected $casts = [
        'data' => 'array',
        'meta' => 'array',
        'published' => 'boolean',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
