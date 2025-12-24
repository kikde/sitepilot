<?php

return [
    'base'   => env('APISHOT_BASE', 'https://apishot.kikde.in'),
    'key'    => env('APISHOT_KEY'),

    // your public renderer base (where Blade views live)
    'view_base' => env('VIEW_BASE', 'https://mdmks.kikde.com'),

    // webhook auth & storage
    'secret' => env('APISHOT_SECRET', '7e9c61b2d59a42d58e237b819f324eeb1f6abbd32a8a84dbbcb6f0b12407de31'),
    'disk'   => env('APISHOT_DISK', 'public'),        // must be "public" for Storage::url()
    'dir'    => 'apishot/results',                    // under storage/app/public
];
