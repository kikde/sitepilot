<?php

namespace Dapunabi\Media\Models;

use Illuminate\Database\Eloquent\Model;

class MediaShare extends Model
{
    protected $table = 'mm_media_shares';
    protected $fillable = ['media_id','token','expires_at','downloads_count','created_by'];
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function getTable()
    {
        return (string) config('media-manager.tables.shares', $this->table);
    }
}
