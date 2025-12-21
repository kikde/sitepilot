<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Mount Path
    |--------------------------------------------------------------------------
    |
    | Primary prefix for NGO site routes.
    | Example: 'ngo' => URLs like /ngo, /ngo/about, /ngo/news-post, etc.
    |
    */
    'mount_path' => env('NGO_MOUNT_PATH', 'ngo'),

    /*
    |--------------------------------------------------------------------------
    | Legacy URLs
    |--------------------------------------------------------------------------
    |
    | When enabled, the plugin also registers legacy, non-prefixed URLs like
    | /about, /contact, /news-post, etc. Disable this when you have multiple
    | websites in the same host app to avoid route collisions.
    |
    */
    'legacy_routes' => (bool) env('NGO_LEGACY_ROUTES', true),

    /*
    |--------------------------------------------------------------------------
    | Legacy Payment Routes
    |--------------------------------------------------------------------------
    |
    | Keeps route names/URLs used by old templates: donate.start, donate.callback,
    | razorpay.webhook, donation.cancelled (non-prefixed). New templates should
    | use ngo.* route names instead.
    |
    */
    'legacy_payment_routes' => (bool) env('NGO_LEGACY_PAYMENT_ROUTES', true),
];

