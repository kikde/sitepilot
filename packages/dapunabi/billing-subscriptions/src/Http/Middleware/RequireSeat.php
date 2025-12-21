<?php

namespace Dapunabi\Billing\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dapunabi\Billing\Support\SeatManager;

class RequireSeat
{
    public function handle(Request $request, Closure $next)
    {
        $userId = Auth::id();
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;

        if ($userId && $tenantId) {
            $sm = new SeatManager();
            $sub = $sm->activeSubscription($tenantId);
            $limit = $sm->allowedSeats($sub);
            if ($limit !== null && $limit >= 0) {
                // Auto-assign if capacity; otherwise block with CTA
                if (! $sm->hasSeat($tenantId, $userId)) {
                    if (! $sm->assign($tenantId, $userId)) {
                        return redirect()->route('billing.seats')->withErrors([
                            'seats' => 'No seats available. Please release a seat or upgrade your plan.',
                        ]);
                    }
                }
            }
        }

        return $next($request);
    }
}

