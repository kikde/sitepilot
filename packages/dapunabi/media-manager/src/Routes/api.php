<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Dapunabi\Media\Services\StorageManager;
use Dapunabi\Media\Services\PresignService;
use Dapunabi\Media\Models\Media;

Route::middleware(['api'])->group(function () {
    Route::post('/api/v1/media/upload', function (Request $request) {
        $request->validate(['file' => 'required|file|max:'.(config('media-manager.max_upload_mb')*1024)]);
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $mgr = app(StorageManager::class);
        $media = $mgr->storeUploadedFile($request->file('file'), $tenantId, auth()->id());
        return response()->json([
            'id' => $media->id,
            'uuid' => $media->uuid,
            'url' => $media->url(),
            'filename' => $media->filename,
            'mime' => $media->mime_type,
            'size' => $media->size,
        ]);
    })->name('api.media.upload');

    // Direct S3 upload: request presign (PUT strategy)
    Route::post('/api/v1/media/presign', function (Request $request) {
        $request->validate([
            'filename' => 'required|string',
            'strategy' => 'nullable|in:put,post',
            'mime' => 'nullable|string',
        ]);
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $disk = config('media-manager.disk','public');
        $ttl = (int) config('media-manager.presign_ttl', 900);
        $svc = app(PresignService::class);
        $key = $svc->makeObjectKey($tenantId, $request->string('filename'));

        // Only PUT supported in this phase
        $data = $svc->presignPut($disk, $key, $ttl);
        if (!empty($data['unsupported'])) {
            return response()->json(['error' => 'Presign not supported for disk '.$disk], 400);
        }
        return response()->json([
            'strategy' => 'put',
            'key' => $key,
            'url' => $data['url'],
            'headers' => $data['headers'] ?? new \stdClass(),
            'token' => $data['token'] ?? null,
        ]);
    })->name('api.media.presign');

    // Direct upload complete: create DB record and enqueue variants
    Route::post('/api/v1/media/complete', function (Request $request, PresignService $presign) {
        $request->validate([
            'key' => 'required|string',
            'original_name' => 'required|string',
            'mime' => 'nullable|string',
            'size' => 'nullable|integer',
            'token' => 'required|string',
        ]);
        if (!$presign->verifyToken($request->string('token'))) {
            return response()->json(['error' => 'Invalid or expired token'], 400);
        }
        $disk = config('media-manager.disk','public');
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $path = $request->string('key');
        // Enforce extension/mime policies
        $blocked = array_map('strtolower', (array) (config('media-manager.blocked_extensions') ?: []));
        $ext = strtolower(pathinfo($request->string('original_name'), PATHINFO_EXTENSION) ?: '');
        if ($ext && in_array($ext, $blocked, true)) {
            return response()->json(['error' => 'File type not allowed'], 400);
        }
        $allowed = (array) (config('media-manager.allowed_mimes') ?: []);
        $mime = (string) ($request->string('mime') ?: 'application/octet-stream');
        if (!empty($allowed)) {
            $ok = false;
            foreach ($allowed as $am) {
                if (str_ends_with($am, '/*')) { $p = substr($am, 0, -1); if (str_starts_with($mime, rtrim($p, '/'))) { $ok = true; break; } }
                elseif (strcasecmp($mime, $am) === 0) { $ok = true; break; }
            }
            if (!$ok) { return response()->json(['error' => 'MIME type not allowed'], 400); }
        }
        // Optional virus scan for s3 (download small file to scan)
        try {
            $cfg = config('media-manager.virus_scan');
            if (($cfg['enabled'] ?? false) && $disk === 's3') {
                $max = ((int) ($cfg['max_scan_mb'] ?? 25)) * 1024 * 1024;
                $size = (int) $request->integer('size') ?: 0;
                if ($size > 0 && $size <= $max) {
                    $tmp = tempnam(sys_get_temp_dir(), 'mm_scan_');
                    file_put_contents($tmp, \Storage::disk($disk)->get($path));
                    if (!app(\Dapunabi\Media\Services\VirusScanService::class)->scanPath($tmp)) {
                        @unlink($tmp);
                        try { \Storage::disk($disk)->delete($path); } catch (\Throwable $e) {}
                        return response()->json(['error' => 'Upload rejected by virus scanner'], 400);
                    }
                    @unlink($tmp);
                }
            }
        } catch (\Throwable $e) {}
        $media = Media::create([
            'tenant_id' => $tenantId,
            'uuid' => \Dapunabi\Media\Models\Media::nextUuid(),
            'filename' => basename($path),
            'original_name' => $request->string('original_name'),
            'mime_type' => $request->string('mime') ?: null,
            'size' => (int) $request->integer('size') ?: 0,
            'disk' => $disk,
            'path' => $path,
            'hash' => null,
            'variants_json' => [],
            'meta_json' => [],
            'tags_json' => [],
            'folder' => null,
            'uploaded_by' => auth()->id(),
            'visibility' => 'private',
        ]);
        // queue variant generation
        try {
            if ($media->isImage()) { \Dapunabi\Media\Jobs\GenerateVariants::dispatch($media->id); }
            if ($media->isPdf()) { \Dapunabi\Media\Jobs\GeneratePdfThumb::dispatch($media->id); }
        } catch (\Throwable $e) {}

        return response()->json([
            'id' => $media->id,
            'uuid' => $media->uuid,
            'url' => $media->url(),
        ]);
    })->name('api.media.complete');

    // Signed download URL
    Route::get('/api/v1/media/{id}/download', function ($id) {
        $media = Media::findOrFail($id);
        $ttl = (int) config('media-manager.download_ttl', 900);
        $svc = app(PresignService::class);
        $url = $svc->downloadUrl($media->disk ?: config('media-manager.disk','public'), $media->path, $ttl);
        return redirect()->away($url);
    })->name('api.media.download');
});
