<?php

return [
    'editor' => [
        'enabled' => true,
        'cdn_vue' => 'https://unpkg.com/vue@3/dist/vue.esm-browser.js',
        'cdn_vuetify' => 'https://cdn.jsdelivr.net/npm/vuetify@3.6.14/dist/vuetify.esm.js',
    ],
    'cache' => [
        'ttl' => 300,
    ],
    'multi_tenant' => [
        'enabled' => true,
    ],

    // Theme presets are default token sets you can switch per-tenant (tenant.settings.theme.preset).
    // Tenants can still override individual tokens via the Theme model or tenant.settings.theme.*
    'theme_presets' => [
        'default' => [
            'primary' => '#1976D2',
            'secondary' => '#10b981',
            'background' => '#ffffff',
            'surface' => '#ffffff',
        ],
        'ngo' => [
            'primary' => '#0ea5e9',
            'secondary' => '#22c55e',
            'background' => '#ffffff',
            'surface' => '#ffffff',
        ],
        'news' => [
            'primary' => '#ef4444',
            'secondary' => '#111827',
            'background' => '#ffffff',
            'surface' => '#ffffff',
        ],
    ],
];
