<?php

namespace Dapunabi\Media\Models;

use Illuminate\Database\Eloquent\Model;

class MediaUsage extends Model
{
    protected $table = 'mm_media_usage';
    protected $fillable = ['tenant_id','media_id','used_in','reference_id'];

    public function getTable()
    {
        return (string) config('media-manager.tables.usage', $this->table);
    }
}
