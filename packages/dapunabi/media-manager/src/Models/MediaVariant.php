<?php

namespace Dapunabi\Media\Models;

use Illuminate\Database\Eloquent\Model;

class MediaVariant extends Model
{
    protected $table = 'mm_media_variants';
    protected $fillable = ['media_id','name','path','width','height','size'];

    public function getTable()
    {
        return (string) config('media-manager.tables.variants', $this->table);
    }
}
