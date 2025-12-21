<?php

namespace Dapunabi\Media\Services;

class VirusScanService
{
    public function enabled(): bool
    {
        return (bool) (config('media-manager.virus_scan.enabled') ?? false);
    }

    public function maxBytes(): int
    {
        return ((int) (config('media-manager.virus_scan.max_scan_mb') ?? 25)) * 1024 * 1024;
    }

    /**
     * Returns true if clean or scanning disabled; false if infected or scan fails decisively.
     */
    public function scanPath(string $path): bool
    {
        if (!$this->enabled()) return true;
        if (!is_readable($path)) return true; // cannot scan
        $driver = (string) (config('media-manager.virus_scan.driver') ?? 'clamav');
        if ($driver === 'clamav') {
            // Try system clamscan
            $cmd = 'clamscan --no-summary '.escapeshellarg($path);
            try {
                $output = [];
                $code = 0;
                @exec($cmd, $output, $code);
                // clamscan returns 0 = OK, 1 = infected, 2 = error
                return $code === 0;
            } catch (\Throwable $e) {
                return true; // fail-open by default
            }
        }
        return true;
    }
}

