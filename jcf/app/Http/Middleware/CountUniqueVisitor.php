<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\VisitorCounter;

class CountUniqueVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Only count GET requests on frontend (skip ajax/assets/admin routes)
        if ($request->isMethod('get')) {
            $path = trim($request->path(), '/');
            $isBackend = str_starts_with($path, 'admin') || str_starts_with($path, 'backend') || str_starts_with($path, 'login') || str_starts_with($path, 'register');
            $isAsset   = str_contains($path, 'assets/') || str_contains($path, 'storage/') || str_contains($path, 'vendor/');
            if (!$isBackend && !$isAsset) {
                $ip = $request->ip() ?: '0.0.0.0';
                VisitorCounter::incrementOncePerIpPerDay($ip);
            }
        }

        return $next($request);
    }
}

