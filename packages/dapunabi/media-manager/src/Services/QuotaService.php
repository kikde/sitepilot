<?php

namespace Dapunabi\Media\Services;

use Illuminate\Support\Facades\DB;
use Dapunabi\Media\Exceptions\QuotaExceededException;

class QuotaService
{
    public function usageBytes(?int $tenantId): int
    {
        $mediaTable = (string) config('media-manager.tables.media', 'mm_media');
        if (!$tenantId) return (int) DB::table($mediaTable)->sum('size');
        return (int) DB::table($mediaTable)->where('tenant_id', $tenantId)->sum('size');
    }

    public function limitBytes(?int $tenantId): int
    {
        $mb = (int) config('media-manager.quota_per_tenant_mb', 1024);
        return $mb > 0 ? ($mb * 1024 * 1024) : PHP_INT_MAX;
    }

    public function canUpload(?int $tenantId, int $incomingBytes): bool
    {
        return ($this->usageBytes($tenantId) + $incomingBytes) <= $this->limitBytes($tenantId);
    }

    public function assertWithinQuota(?int $tenantId, int $incomingBytes): void
    {
        if (!$this->canUpload($tenantId, $incomingBytes)) {
            throw new QuotaExceededException('Storage quota exceeded for tenant.');
        }
    }

    public function bumpStats(?int $tenantId, int $bytesDelta, int $filesDelta): void
    {
        $statsTable = (string) config('media-manager.tables.storage_stats', 'mm_media_storage_stats');
        // Lightweight tracker in media_storage_stats; recompute command also exists
        $row = DB::table($statsTable)->where('tenant_id', $tenantId ?: 0)->first();
        if ($row) {
            DB::table($statsTable)->where('tenant_id', $tenantId ?: 0)->update([
                'total_bytes' => max(0, (int) $row->total_bytes + $bytesDelta),
                'file_count' => max(0, (int) $row->file_count + $filesDelta),
                'updated_at' => now(),
            ]);
        } else {
            DB::table($statsTable)->insert([
                'tenant_id' => $tenantId ?: 0,
                'total_bytes' => max(0, $bytesDelta),
                'file_count' => max(0, $filesDelta),
                'updated_at' => now(),
            ]);
        }
    }
}
