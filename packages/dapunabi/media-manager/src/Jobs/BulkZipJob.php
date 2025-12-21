<?php

namespace Dapunabi\Media\Jobs;

use Dapunabi\Media\Models\Media;
use Dapunabi\Media\Services\QuotaService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class BulkZipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ?int $tenantId;
    public array $mediaIds;
    public ?int $userId;

    public function __construct(?int $tenantId, array $mediaIds, ?int $userId)
    {
        $this->tenantId = $tenantId;
        $this->mediaIds = $mediaIds;
        $this->userId = $userId;
        $this->onQueue('media');
    }

    public function handle(): void
    {
        $items = Media::whereIn('id', $this->mediaIds)->get();
        if ($items->isEmpty()) return;

        $disk = config('media-manager.disk','public');
        $exportsDir = ($this->tenantId ? 'tenants/'.$this->tenantId.'/exports' : 'exports');
        $zipName = 'media-'.date('Ymd-His').'.zip';
        $zipRel = $exportsDir.'/'.$zipName;
        $zipAbs = Storage::disk($disk)->path($exportsDir).DIRECTORY_SEPARATOR.$zipName;

        // Ensure directory exists
        @mkdir(dirname($zipAbs), 0777, true);

        $zip = new \ZipArchive();
        if (true !== $zip->open($zipAbs, \ZipArchive::CREATE|\ZipArchive::OVERWRITE)) {
            return; // fail silently
        }

        foreach ($items as $m) {
            try {
                // Try to get absolute path; fallback to streaming into temp file
                $abs = null;
                try { $abs = Storage::disk($m->disk)->path($m->path); } catch (\Throwable $e) {}
                $localTmp = null;
                if (!$abs || !file_exists($abs)) {
                    $data = Storage::disk($m->disk)->get($m->path);
                    $localTmp = sys_get_temp_dir().DIRECTORY_SEPARATOR.'mm_'.uniqid().'-'.$m->filename;
                    file_put_contents($localTmp, $data);
                    $abs = $localTmp;
                }
                $entryName = $m->original_name ?: $m->filename;
                $zip->addFile($abs, $entryName);
                if ($localTmp && file_exists($localTmp)) @unlink($localTmp);
            } catch (\Throwable $e) { /* skip */ }
        }

        $zip->close();

        // Create Media record for the zip so user can find it
        try {
            $size = @filesize($zipAbs) ?: 0;
            app(QuotaService::class)->assertWithinQuota($this->tenantId, (int) $size);
            Media::create([
                'tenant_id' => $this->tenantId,
                'uuid' => Media::nextUuid(),
                'filename' => basename($zipRel),
                'original_name' => basename($zipRel),
                'mime_type' => 'application/zip',
                'size' => (int) $size,
                'disk' => $disk,
                'path' => $zipRel,
                'hash' => null,
                'variants_json' => [],
                'meta_json' => [],
                'tags_json' => [],
                'folder' => 'exports',
                'uploaded_by' => $this->userId,
                'visibility' => 'private',
            ]);
        } catch (\Throwable $e) { /* ignore */ }
    }
}

