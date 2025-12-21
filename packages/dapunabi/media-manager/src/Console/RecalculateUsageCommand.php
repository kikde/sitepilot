<?php

namespace Dapunabi\Media\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RecalculateUsageCommand extends Command
{
    protected $signature = 'media:recalculate-usage {--tenant=}';
    protected $description = 'Recalculate media_storage_stats from media table totals';

    public function handle(): int
    {
        $mediaTable = (string) config('media-manager.tables.media', 'mm_media');
        $statsTable = (string) config('media-manager.tables.storage_stats', 'mm_media_storage_stats');

        $tenant = $this->option('tenant');
        $this->info('Recomputing totals...');
        $tenants = DB::table($mediaTable)
            ->when($tenant, fn($q)=>$q->where('tenant_id', (int) $tenant))
            ->select('tenant_id', DB::raw('SUM(size) as total_bytes'), DB::raw('COUNT(*) as file_count'))
            ->groupBy('tenant_id')
            ->get();

        // Clear stats for scope
        if ($tenant !== null) {
            DB::table($statsTable)->where('tenant_id', (int) $tenant)->delete();
        } else {
            DB::table($statsTable)->truncate();
        }

        foreach ($tenants as $row) {
            DB::table($statsTable)->insert([
                'tenant_id' => (int) ($row->tenant_id ?? 0),
                'total_bytes' => (int) $row->total_bytes,
                'file_count' => (int) $row->file_count,
                'updated_at' => now(),
            ]);
        }
        $this->info('Done. Rows: '.count($tenants));
        return self::SUCCESS;
    }
}
