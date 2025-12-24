<?php
return [
    // allowed theme keys
    'allowed' => ['demo1', 'demo2', 'demo3', 'demo4', 'demo5', 'demo6'],

    // per-theme settings
    'map' => [
        'demo1' => [
            'header' => 'style-1',
            'footer' => 'style-1',
            'body_class' => 'blue-color',
            'vite_css' => 'resources/css/themes/demo1.css',
        ],
        'demo2' => [
            'header' => 'style-2',
            'footer' => 'style-2',
            'body_class' => 'red-color',
            'vite_css' => 'resources/css/themes/demo2.css',
        ],
         'demo3' => [
            'header' => 'style-3',
            'footer' => 'style-3',
            'body_class' => 'red-color',
            'vite_css' => 'resources/css/themes/demo3.css',
        ],
        'demo4' => [
            'header' => 'style-4',
            'footer' => 'style-4',
            'body_class' => 'red-color',
            'vite_css' => 'resources/css/themes/demo4.css',
        ],
        'demo5' => [
            'header' => 'style-5',
            'footer' => 'style-1',
            'body_class' => 'red-color',
            'vite_css' => 'resources/css/themes/demo5.css',
        ],
        'demo6' => [
            'header' => 'style-6',
            'footer' => 'style-1',
            'body_class' => 'red-color',
            'vite_css' => 'resources/css/themes/demo6.css',
        ],
    ],
    // default/fallback
    'default' => '/',
];
