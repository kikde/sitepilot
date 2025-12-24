<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class VisitorCounter
{
    protected static function filePath(): string
    {
        return storage_path('app/visitors_total.txt');
    }

    public static function total(): int
    {
        $path = self::filePath();
        if (!is_file($path)) {
            return 0;
        }
        $val = @file_get_contents($path);
        return is_numeric($val) ? (int)$val : 0;
    }

    public static function incrementOncePerIpPerDay(string $ip): void
    {
        $date = now()->format('Ymd');
        $key  = "visitor:{$date}:{$ip}";

        // Only count once per IP per day
        if (!Cache::add($key, 1, now()->endOfDay())) {
            return; // already counted today
        }

        self::incrementPersistent();
    }

    protected static function incrementPersistent(): void
    {
        $path = self::filePath();

        // Ensure directory exists
        @mkdir(dirname($path), 0775, true);

        $current = 0;
        if (is_file($path)) {
            $raw = @file_get_contents($path);
            $current = is_numeric($raw) ? (int)$raw : 0;
        }

        $next = $current + 1;
        @file_put_contents($path, (string)$next, LOCK_EX);
    }
}

