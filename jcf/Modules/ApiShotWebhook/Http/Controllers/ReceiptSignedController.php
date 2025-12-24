<?php

namespace Modules\ApiShotWebhook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReceiptSignedController extends Controller
{
    public function show(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            abort(401, 'Invalid or expired link');
        }

        // Reuse your existing page rendering (adjust to your real controller method):
        return app()->call([\App\Http\Controllers\ReceiptController::class, 'show'], ['id' => $id]);
    }
}
