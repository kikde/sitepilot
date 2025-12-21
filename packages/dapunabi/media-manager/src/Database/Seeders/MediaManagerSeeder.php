<?php

namespace Dapunabi\Media\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Dapunabi\Media\Models\Media;

class MediaManagerSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: seed a sample row (no file) for UI smoke
        if (!Media::first()) {
            Media::create([
                'tenant_id' => null,
                'uuid' => (string) Str::uuid(),
                'filename' => 'placeholder.txt',
                'original_name' => 'placeholder.txt',
                'mime_type' => 'text/plain',
                'size' => 12,
                'disk' => config('media-manager.disk','public'),
                'path' => 'media/'.date('Y/m/d').'/placeholder.txt',
                'hash' => null,
                'visibility' => 'private',
            ]);
        }
    }
}

