<?php

namespace Modules\ApiShotWebhook\Support;

use Illuminate\Support\Facades\URL;

class SignedLink
{
    /** Create a temporary signed URL to a receipt detail page. */
    public static function receipt(int|string $id, int $minutes = 5): string
    {
        // Route name must exist (see Step 2 for /payment-receipt/signed/{id})
        return URL::temporarySignedRoute(
            'apishot.receipt.signed',
            now()->addMinutes($minutes),
            ['id' => $id]
        );
    }
}
