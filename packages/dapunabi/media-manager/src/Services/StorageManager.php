<?php

namespace Dapunabi\Media\Services;

use Dapunabi\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Dapunabi\Media\Jobs\GenerateVariants;
use Dapunabi\Media\Jobs\GeneratePdfThumb;
use Dapunabi\Media\Services\QuotaService;
use Dapunabi\Media\Services\VirusScanService;
use Dapunabi\Media\Events\MediaUploaded;

class StorageManager
{
    public function storeUploadedFile(UploadedFile $file, ?int $tenantId, ?int $uploadedBy = null): Media
    {
        $disk = config('media-manager.disk','public');
        $ext = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'bin');
        // Security: extension and MIME restrictions
        $blocked = array_map('strtolower', (array) (config('media-manager.blocked_extensions') ?: []));
        if (in_array($ext, $blocked, true)) {
            throw new \InvalidArgumentException('File type not allowed.');
        }
        $mime = (string) ($file->getClientMimeType() ?: 'application/octet-stream');
        $allowed = (array) (config('media-manager.allowed_mimes') ?: []);
        if (!empty($allowed)) {
            $ok = false;
            foreach ($allowed as $am) {
                if (str_ends_with($am, '/*')) {
                    $prefix = substr($am, 0, -1);
                    if (str_starts_with($mime, rtrim($prefix, '/'))) { $ok = true; break; }
                } elseif (strcasecmp($mime, $am) === 0) {
                    $ok = true; break;
                }
            }
            if (!$ok) {
                throw new \InvalidArgumentException('MIME type not allowed.');
            }
        }
        $uuid = Media::nextUuid();
        $datePath = date('Y/m/d');
        $tenantPart = $tenantId ? 'tenants/'.$tenantId.'/media' : 'media';
        $relative = $tenantPart.'/'.$datePath.'/'.$uuid.'.'.$ext;

        // Enforce quota before writing
        $incoming = (int) $file->getSize();
        try { app(QuotaService::class)->assertWithinQuota($tenantId, $incoming); } catch (\Throwable $e) { throw $e; }
        $localTmpPath = $file->getRealPath();
        if (!is_string($localTmpPath) || $localTmpPath === '') {
            $localTmpPath = $file->getPathname();
        }
        if (!is_string($localTmpPath) || $localTmpPath === '' || !is_file($localTmpPath)) {
            $localTmpPath = null;
        }

        // Optional virus scan on local temp file
        try {
            $scanner = app(VirusScanService::class);
            if ($scanner->enabled() && $incoming <= $scanner->maxBytes()) {
                if ($localTmpPath && !$scanner->scanPath($localTmpPath)) {
                    throw new \RuntimeException('Upload rejected by virus scanner.');
                }
            }
        } catch (\Throwable $e) {
            if ($e instanceof \RuntimeException) { throw $e; }
        }

        // Compute hash for dedupe
        $hash = $localTmpPath ? (@hash_file('sha256', $localTmpPath) ?: null) : null;
        $scope = config('media-manager.dedupe_scope', 'tenant');
        $mode = config('media-manager.dedupe_mode', 'reuse_path');
        $existing = null;
        if ($hash) {
            $q = \Dapunabi\Media\Models\Media::query()->where('hash', $hash);
            if ($scope === 'tenant') {
                $mediaTable = (string) config('media-manager.tables.media', 'mm_media');
                if (\Illuminate\Support\Facades\Schema::hasColumn($mediaTable, 'tenant_id')) {
                    $q->where('tenant_id', $tenantId);
                }
            }
            $existing = $q->first();
        }

        if ($existing && $mode === 'reuse_path') {
            // Skip writing file; reuse existing storage path
            $path = $existing->path;
        } else {
            $path = Storage::disk($disk)->putFileAs(dirname($relative), $file, basename($relative));
        }

        $payload = [
            'tenant_id' => $tenantId,
            'uuid' => $uuid,
            'filename' => basename($relative),
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType() ?: 'application/octet-stream',
            'size' => $file->getSize(),
            'disk' => $disk,
            'path' => $path,
            'hash' => $hash,
            'variants_json' => [],
            'meta_json' => [],
            'tags_json' => [],
            'folder' => null,
            'uploaded_by' => $uploadedBy,
            'visibility' => 'private',
        ];

        $mediaTable = (string) config('media-manager.tables.media', 'mm_media');
        if (!\Illuminate\Support\Facades\Schema::hasColumn($mediaTable, 'tenant_id')) {
            unset($payload['tenant_id']);
        }

        $media = Media::create($payload);

        if ($existing && $mode === 'reuse_record') {
            // If configured to reuse record, return existing and ignore new row
            try { $media->delete(); } catch (\Throwable $e) {}
            return $existing;
        }
        // bump lightweight stats
        try { app(QuotaService::class)->bumpStats($tenantId, $media->size, 1); } catch (\Throwable $e) {}
        // Fire upload event
        try { event(new MediaUploaded($media)); } catch (\Throwable $e) {}
        // Dispatch background processing
        try {
            if ($media->isImage()) {
                GenerateVariants::dispatch($media->id);
            } elseif ($media->isPdf()) {
                GeneratePdfThumb::dispatch($media->id);
            }
        } catch (\Throwable $e) {
            // queue may be disabled in dev; ignore
        }
        return $media;
    }
}


