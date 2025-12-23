<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\VisitorCounter;

class CountVisitor
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Only for typical web requests; skip if running tests or artisan
            if (php_sapi_name() !== 'cli') {
                VisitorCounter::incrementOncePerIpPerDay($request->ip() ?? 'unknown');
            }
        } catch (\Throwable $e) {
            // Swallow errors; never block the request due to counter issues
        }

        return $next($request);
    }
}