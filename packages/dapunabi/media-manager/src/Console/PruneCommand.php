<?php

namespace Dapunabi\Media\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PruneCommand extends Command
{
    protected $signature = 'media:prune {--dry-run : Only show what would be deleted} {--tenant=}';
    protected $description = 'Prune unreferenced media (no entries in media_usage).';

    public function handle(): int
    {
        $mediaTable = (string) config('media-manager.tables.media', 'mm_media');
        $usageTable = (string) config('media-manager.tables.usage', 'mm_media_usage');
        $variantsTable = (string) config('media-manager.tables.variants', 'mm_media_variants');
        $sharesTable = (string) config('media-manager.tables.shares', 'mm_media_shares');
        $statsTable = (string) config('media-manager.tables.storage_stats', 'mm_media_storage_stats');

        $dry = (bool) $this->option('dry-run');
        $tenant = $this->option('tenant');

        $q = DB::table($mediaTable.' as m')
            ->leftJoin($usageTable.' as u', 'u.media_id', '=', 'm.id')
            ->select('m.id','m.disk','m.path','m.size','m.tenant_id')
            ->whereNull('u.id');
        if ($tenant !== null) {
            $q->where('m.tenant_id', (int) $tenant);
        }
        $unused = $q->orderBy('m.id')->get();

        $bytes = (int) $unused->sum('size');
        $this->info(($dry ? '[DRY-RUN] ' : '').'Unused files: '.count($unused).' — total '.number_format($bytes/1024,1).' KB');

        if ($dry || $unused->isEmpty()) {
            foreach ($unused->take(50) as $row) {
                $this->line(' - #'.$row->id.' '.$row->path);
            }
            return self::SUCCESS;
        }

        if (!$this->confirm('Delete these files from storage and DB?')) {
            $this->warn('Aborted.');
            return self::SUCCESS;
        }

        $deleted = 0;
        foreach ($unused as $row) {
            try {
                // Delete variants
                $variants = DB::table($variantsTable)->where('media_id', $row->id)->get();
                foreach ($variants as $v) {
                    Storage::disk($row->disk)->delete($v->path);
                }
                DB::table($variantsTable)->where('media_id', $row->id)->delete();
                // Delete shares
                DB::table($sharesTable)->where('media_id', $row->id)->delete();
                // Delete main file
                Storage::disk($row->disk)->delete($row->path);
                DB::table($mediaTable)->where('id', $row->id)->delete();
                try { event(new \Dapunabi\Media\Events\MediaDeleted($row->id)); } catch (\Throwable $e) {}
                // Update stats
                DB::table($statsTable)->where('tenant_id', $row->tenant_id ?: 0)->decrement('total_bytes', (int) $row->size);
                DB::table($statsTable)->where('tenant_id', $row->tenant_id ?: 0)->decrement('file_count', 1);
                $deleted++;
            } catch (\Throwable $e) {
                $this->error('Failed to delete #'.$row->id.': '.$e->getMessage());
            }
        }

        $this->info('Deleted '.$deleted.' files.');
        return self::SUCCESS;
    }
}
