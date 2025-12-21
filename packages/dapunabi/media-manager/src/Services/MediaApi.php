<?php

namespace Dapunabi\Media\Services;

use Dapunabi\Media\Models\Media;
use Dapunabi\Media\Models\MediaUsage;
use Illuminate\Support\Facades\DB;

class MediaApi
{
    public function url(int $mediaId): ?string
    {
        $m = Media::find($mediaId);
        return $m?->url();
    }

    public function variantUrl(int $mediaId, string $name): ?string
    {
        $m = Media::find($mediaId);
        return $m?->variantUrl($name);
    }

    public function recordUsage(int $mediaId, string $usedIn, string|int|null $referenceId = null, ?int $tenantId = null): void
    {
        $tenantId = $tenantId ?? (Media::find($mediaId)?->tenant_id);
        MediaUsage::create([
            'tenant_id' => $tenantId,
            'media_id' => $mediaId,
            'used_in' => $usedIn,
            'reference_id' => (string) ($referenceId ?? ''),
        ]);
    }

    public function removeUsage(int $mediaId, string $usedIn, string|int|null $referenceId = null): void
    {
        $usageTable = (string) config('media-manager.tables.usage', 'mm_media_usage');
        DB::table($usageTable)
            ->where('media_id', $mediaId)
            ->where('used_in', $usedIn)
            ->when($referenceId !== null, fn($q)=>$q->where('reference_id', (string)$referenceId))
            ->delete();
    }

    /**
     * @return array<int, array{used_in:string,reference_id:string}>
     */
    public function usages(int $mediaId): array
    {
        return MediaUsage::where('media_id', $mediaId)
            ->get(['used_in','reference_id'])
            ->map(fn($r)=>['used_in'=>$r->used_in,'reference_id'=>$r->reference_id])
            ->all();
    }
}
