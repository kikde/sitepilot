<?php

use Illuminate\Support\Facades\App;

if (! function_exists('currentTenant')) {
    function currentTenant() {
        return App::bound('currentTenant') ? App::make('currentTenant') : null;
    }
}

if (! function_exists('tenant_id')) {
    function tenant_id(): ?int {
        $t = currentTenant();
        return $t?->id;
    }
}

if (! function_exists('tenant_storage_usage_mb')) {
    function tenant_storage_usage_mb($tenant = null): float {
        $tenant = $tenant ?: currentTenant();
        if (! $tenant) return 0.0;
        $base = storage_path('app/public/tenant-uploads/'.($tenant->id));
        $bytes = 0;
        if (is_dir($base)) {
            $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base, FilesystemIterator::SKIP_DOTS));
            foreach ($rii as $file) {
                if ($file->isFile()) {
                    $bytes += $file->getSize();
                }
            }
        }
        return $bytes / 1024 / 1024;
    }
}
