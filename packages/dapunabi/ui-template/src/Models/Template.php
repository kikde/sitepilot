<?php

namespace Dapunabi\UiTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'ui_templates';
    protected $fillable = [
        'tenant_id','name','slug','type','data','meta','published'
    ];
    protected $casts = [
        'data' => 'array',
        'meta' => 'array',
        'published' => 'boolean',
    ];

    public function revisions()
    {
        return $this->hasMany(TemplateRevision::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
