<?php

namespace Dapunabi\UiTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'ui_sections';
    protected $fillable = [
        'tenant_id','page_id','template_id','key','blocks','position'
    ];
    protected $casts = [
        'blocks' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
