<?php

namespace Dapunabi\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $table = 'mm_media';
    protected $fillable = [
        'tenant_id','uuid','filename','original_name','mime_type','size','disk','path','hash','variants_json','meta_json','tags_json','folder','uploaded_by','visibility'
    ];

    protected $casts = [
        'variants_json' => 'array',
        'meta_json' => 'array',
        'tags_json' => 'array',
    ];

    public function variants(): HasMany { return $this->hasMany(MediaVariant::class); }
    public function usages(): HasMany { return $this->hasMany(MediaUsage::class); }

    public function getTable()
    {
        return (string) config('media-manager.tables.media', $this->table);
    }

    public function url(): string
    {
        $cdn = rtrim((string) config('media-manager.cdn_url', ''), '/');
        if ($cdn !== '') {
            return $cdn.'/'.ltrim($this->path, '/');
        }
        return Storage::disk($this->disk ?: config('media-manager.disk','public'))
            ->url($this->path);
    }

    public function isImage(): bool
    {
        return is_string($this->mime_type) && str_starts_with(strtolower($this->mime_type), 'image/');
    }

    public function isPdf(): bool
    {
        return strtolower((string) $this->mime_type) === 'application/pdf';
    }

    public function variant(string $name): ?MediaVariant
    {
        return $this->variants()->where('name', $name)->first();
    }

    public function variantUrl(string $name): ?string
    {
        $v = $this->variant($name);
        if (! $v) return null;
        $cdn = rtrim((string) config('media-manager.cdn_url', ''), '/');
        if ($cdn !== '') {
            return $cdn.'/'.ltrim($v->path, '/');
        }
        return \Storage::disk($this->disk ?: config('media-manager.disk','public'))->url($v->path);
    }

    public static function nextUuid(): string
    {
        return (string) Str::uuid();
    }
}
