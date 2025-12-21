<?php

namespace Dapunabi\UiTemplate\Services;

use Dapunabi\UiTemplate\Models\Page;
use Dapunabi\UiTemplate\Models\Template;

class TemplateRepository
{
    public function pageBySlug(string $slug, ?int $tenantId = null, ?string $locale = 'en'): ?Page
    {
        $locale = $locale ?: 'en';
        if ($tenantId) {
            $p = Page::where('tenant_id', $tenantId)->where('slug', $slug)->where('locale', $locale)->first();
            if ($p) return $p;
            // fallback same tenant any locale
            $p = Page::where('tenant_id', $tenantId)->where('slug', $slug)->first();
            if ($p) return $p;
        }
        // global fallback
        $p = Page::whereNull('tenant_id')->where('slug', $slug)->where('locale', $locale)->first();
        if ($p) return $p;
        return Page::whereNull('tenant_id')->where('slug', $slug)->first();
    }

    public function templateBySlug(string $slug, ?int $tenantId = null, ?string $locale = 'en'): ?Template
    {
        if ($tenantId) {
            $t = Template::where('tenant_id', $tenantId)->where('slug', $slug)->first();
            if ($t) return $t;
        }
        return Template::whereNull('tenant_id')->where('slug', $slug)->first();
    }
}
