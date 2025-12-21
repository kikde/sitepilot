<?php

namespace Dapunjabi\CoreAuth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Dapunjabi\CoreAuth\Support\TenantManager;

class EnsureTenantSeedData
{
    public function handle($request, Closure $next)
    {
        try {
            $tm = app(TenantManager::class);
            $tenantId = $tm->current()?->id ?? (function_exists('tenant_id') ? tenant_id() : null);
            if (!$tenantId) {
                return $next($request);
            }
            $tid = (int) $tenantId;

            $this->ensureSingleRowFromTemplate('settings', $tid);
            $this->ensureAllRowsFromTemplate('partners', $tid);
            $this->ensureAllRowsFromTemplate('galleries', $tid);
            $this->ensureAllRowsFromTemplate('email_templates', $tid);
            $this->ensureAllRowsFromTemplate('categories', $tid);

            // Home page sections used by NGO frontend/admin
            $this->ensureAllRowsFromTemplate('home_banners', $tid);
            $this->ensureAllRowsFromTemplate('home_todos', $tid);
            $this->ensureSingleRowFromTemplate('home_award_static', $tid);
            $this->ensureAllRowsFromTemplate('home_award_section', $tid);
            $this->ensureAllRowsFromTemplate('manageteams', $tid);
            $this->ensureAllRowsFromTemplate('testimonials', $tid);
            $this->ensureAllRowsFromTemplate('faqs', $tid);
        } catch (\Throwable $e) {
        }

        return $next($request);
    }

    private function ensureSingleRowFromTemplate(string $table, int $tenantId): void
    {
        if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'tenant_id')) return;
        if (DB::table($table)->where('tenant_id', $tenantId)->exists()) return;
        $tpl = DB::table($table)->whereNull('tenant_id')->first();
        if (!$tpl) return;

        $data = (array) $tpl;
        unset($data['id']);
        $data['tenant_id'] = $tenantId;
        $data['created_at'] = $data['created_at'] ?? now();
        $data['updated_at'] = now();
        DB::table($table)->insert($data);
    }

    private function ensureAllRowsFromTemplate(string $table, int $tenantId): void
    {
        if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'tenant_id')) return;
        if (DB::table($table)->where('tenant_id', $tenantId)->exists()) return;

        $rows = DB::table($table)->whereNull('tenant_id')->get();
        if ($rows->isEmpty()) return;

        foreach ($rows as $row) {
            $data = (array) $row;
            unset($data['id']);
            $data['tenant_id'] = $tenantId;
            $data['created_at'] = $data['created_at'] ?? now();
            $data['updated_at'] = now();
            DB::table($table)->insert($data);
        }
    }
}
