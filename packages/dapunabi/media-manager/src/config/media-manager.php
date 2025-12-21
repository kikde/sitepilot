<?php

return [
    // Table names are configurable to avoid collisions (e.g. Spatie medialibrary uses `media`).
    'tables' => [
        'media' => env('MEDIA_MANAGER_MEDIA_TABLE', 'mm_media'),
        'variants' => env('MEDIA_MANAGER_VARIANTS_TABLE', 'mm_media_variants'),
        'usage' => env('MEDIA_MANAGER_USAGE_TABLE', 'mm_media_usage'),
        'shares' => env('MEDIA_MANAGER_SHARES_TABLE', 'mm_media_shares'),
        'storage_stats' => env('MEDIA_MANAGER_STORAGE_STATS_TABLE', 'mm_media_storage_stats'),
        'versions' => env('MEDIA_MANAGER_VERSIONS_TABLE', 'mm_media_versions'),
    ],
    'disk' => env('MEDIA_DISK', 'public'), // use 'public' so URLs work with storage:link
    'cdn_url' => env('MEDIA_CDN_URL', ''),
    'max_upload_mb' => (int) env('MEDIA_MAX_UPLOAD_MB', 50),
    'image_driver' => env('MEDIA_IMAGE_DRIVER', 'gd'),
    'pdf_thumbs' => filter_var(env('MEDIA_PDF_THUMBS', true), FILTER_VALIDATE_BOOLEAN),
    'presign_ttl' => 900,
    'download_ttl' => (int) env('MEDIA_DOWNLOAD_TTL', 900),
    'use_temporary_url' => true, // for S3: use Storage temporaryUrl for downloads
    'share_ttl_default' => 86400,
    'quota_per_tenant_mb' => (int) env('MEDIA_QUOTA_MB', 1024),
    // Deduplication
    'dedupe_scope' => env('MEDIA_DEDUPE_SCOPE', 'tenant'), // tenant|global
    'dedupe_mode' => env('MEDIA_DEDUPE_MODE', 'reuse_path'), // reuse_path|reuse_record

    // Security & Compliance
    'allowed_mimes' => array_filter(array_map('trim', explode(',', env('MEDIA_ALLOWED_MIMES', 'image/jpeg,image/png,image/webp,application/pdf')))),
    'blocked_extensions' => array_filter(array_map('trim', explode(',', env('MEDIA_BLOCKED_EXT', 'exe,bat,cmd,sh,php,js')))),
    'virus_scan' => [
        'enabled' => filter_var(env('MEDIA_VIRUS_SCAN', false), FILTER_VALIDATE_BOOLEAN),
        'driver' => env('MEDIA_VIRUS_DRIVER', 'clamav'), // clamav|none
        'max_scan_mb' => (int) env('MEDIA_VIRUS_MAX_MB', 25),
    ],
    // Application-level signing for presign completion/download tokens
    'signing' => [
        'kid' => env('MEDIA_SIGN_KID', 'v1'),
        'secret' => env('MEDIA_SIGN_SECRET', ''), // HMAC secret for tokens (rotatable)
        'rotate_before' => env('MEDIA_SIGN_ROTATE_BEFORE', ''), // ISO datetime; tokens issued before are invalid
    ],
];
