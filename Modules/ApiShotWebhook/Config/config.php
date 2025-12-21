<?php

return [
    // inbound verify (must match Apishot clients.webhook_secret)
    'webhook_secret'   => env('APISHOT_WEBHOOK_SECRET', ''),

    // skew guard
    'allow_skew_secs'  => env('APISHOT_ALLOW_SKEW_SECS', 300),

    // where to store downloaded results (under storage/app/public/<value>)
    'store_path'       => env('APISHOT_STORE_PATH', 'apishot/results'),

    // outbound (mdmks -> apishot) convenience
    'base'             => env('APISHOT_BASE', ''),
    'key'              => env('APISHOT_KEY', ''),
    'header'           => env('APISHOT_HEADER', 'x-api-key'),
];
