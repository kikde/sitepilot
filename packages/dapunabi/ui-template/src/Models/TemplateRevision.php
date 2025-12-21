<?php

namespace Dapunabi\UiTemplate\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateRevision extends Model
{
    protected $table = 'ui_template_revisions';
    protected $fillable = [
        'tenant_id','template_id','version','payload','user_id'
    ];
    protected $casts = [
        'payload' => 'array',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
