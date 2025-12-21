<?php

return [
    'auto_create' => env('TENANCY_AUTO_CREATE', true),
    'resolver' => [
        'header' => 'X-Tenant',
        'path_prefix' => 't',
    ],
];

