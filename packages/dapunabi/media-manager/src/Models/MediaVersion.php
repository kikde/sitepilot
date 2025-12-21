<?php

namespace Dapunabi\Media\Models;

use Illuminate\Database\Eloquent\Model;

class MediaVersion extends Model
{
    protected $table = 'mm_media_versions';
    protected $fillable = [
        'media_id','version_no','disk','path','size','mime_type','filename','original_name','uploaded_by'
    ];

    public function getTable()
    {
        return (string) config('media-manager.tables.versions', $this->table);
    }
}
