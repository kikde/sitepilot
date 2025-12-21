<?php

return [
    'currency' => 'USD',
    'sandbox' => true,
    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
    ],
    // Phase 6: grace period + auto suspend
    'grace_period_days' => env('BILLING_GRACE_DAYS', 7),
    'suspend_after_grace' => env('BILLING_SUSPEND_AFTER_GRACE', true),
];
