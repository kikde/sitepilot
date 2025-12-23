<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Count unique visitors (once per IP per day)
        if (class_exists(\App\Http\Middleware\CountVisitor::class)) {
            $middleware->appendToGroup('web', \App\Http\Middleware\CountVisitor::class);
        }
        // Ensure tenant is resolved from domain/path/header early for all web requests.
        // This binds `currentTenant()` / `tenant_id()` (TenancyAdapter) and enables per-tenant data isolation.
        if (class_exists(\Dapunjabi\TenancyAdapter\Http\Middleware\TenantResolveMiddleware::class)) {
            $middleware->prependToGroup('web', \Dapunjabi\TenancyAdapter\Http\Middleware\TenantResolveMiddleware::class);
        }
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
