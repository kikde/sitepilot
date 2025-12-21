<?php

namespace Dapunabi\UiTemplate\Services;

use Illuminate\Support\Facades\Cache;
use Dapunabi\UiTemplate\Models\Page;

class TemplateRenderer
{
    public function __construct(
        protected Renderer $renderer,
        protected BlockRegistry $blocks
    ) {}

    public function renderCached(Page $page): string
    {
        $tenantId = (int) ($page->tenant_id ?? 0);
        $slug = (string) $page->slug;
        $key = $this->key($tenantId, $slug);
        $ttl = $this->computeTtl($page);

        // Try taggable cache first
        try {
            $val = Cache::tags(['ui-template', $this->tenantTag($tenantId), $this->pageTag($slug)])->get($key);
            if (is_string($val)) return $val;
            $html = $this->renderer->renderPage($page);
            Cache::tags(['ui-template', $this->tenantTag($tenantId), $this->pageTag($slug)])->put($key, $html, $ttl);
            $this->indexKey($tenantId, $key);
            return $html;
        } catch (\Throwable $e) {
            // Fallback non-taggable cache
            $val = Cache::get($key);
            if (is_string($val)) return $val;
            $html = $this->renderer->renderPage($page);
            Cache::put($key, $html, $ttl);
            $this->indexKey($tenantId, $key);
            return $html;
        }
    }

    public function invalidate(int $tenantId, string $slug): void
    {
        $key = $this->key($tenantId, $slug);
        try {
            Cache::tags([$this->tenantTag($tenantId), $this->pageTag($slug)])->forget($key);
        } catch (\Throwable $e) {
            Cache::forget($key);
        }
        $this->removeFromIndex($tenantId, $key);
    }

    public function invalidateTenant(int $tenantId): void
    {
        try {
            Cache::tags([$this->tenantTag($tenantId)])->flush();
        } catch (\Throwable $e) {
            // No tags support; fall back to index list
            $listKey = $this->tenantIndexKey($tenantId);
            $keys = Cache::get($listKey, []);
            if (is_array($keys)) {
                foreach ($keys as $k) Cache::forget($k);
            }
            Cache::forget($listKey);
        }
    }

    protected function computeTtl(Page $page): int
    {
        $default = (int) config('ui-template.cache.ttl', 300);
        $data = is_array($page->data) ? $page->data : [];
        $ttls = [];
        foreach (($data['blocks'] ?? []) as $b) {
            $ttl = null;
            if (isset($b['props']['cache_ttl'])) {
                $ttl = (int) $b['props']['cache_ttl'];
            } else {
                $man = $this->blocks->get($b['key'] ?? '') ?? [];
                if (isset($man['ttl'])) $ttl = (int) $man['ttl'];
            }
            if ($ttl && $ttl > 0) $ttls[] = $ttl;
        }
        if (!empty($ttls)) return min($ttls);
        return $default;
    }

    protected function key(int $tenantId, string $slug): string
    {
        // Include locale if present on page model by reading via debug_backtrace if available.
        // Simpler: append currently resolved locale from request if set.
        $locale = request()->query('locale');
        $loc = $locale ? (string) $locale : 'en';
        return 'uitpl:page:'.$tenantId.':'.$slug.':'.$loc.':v1';
    }

    protected function tenantTag(int $tenantId): string
    {
        return 'uitpl-tenant:'.$tenantId;
    }

    protected function pageTag(string $slug): string
    {
        $locale = request()->query('locale');
        $loc = $locale ? (string) $locale : 'en';
        return 'uitpl-page:'.$slug.':'.$loc;
    }

    protected function tenantIndexKey(int $tenantId): string
    {
        return 'uitpl:tenant:'.$tenantId.':pages';
    }

    protected function indexKey(int $tenantId, string $key): void
    {
        $listKey = $this->tenantIndexKey($tenantId);
        $keys = Cache::get($listKey, []);
        if (!is_array($keys)) $keys = [];
        if (!in_array($key, $keys, true)) {
            $keys[] = $key;
            Cache::put($listKey, $keys, 86400);
        }
    }

    protected function removeFromIndex(int $tenantId, string $key): void
    {
        $listKey = $this->tenantIndexKey($tenantId);
        $keys = Cache::get($listKey, []);
        if (!is_array($keys)) return;
        $keys = array_values(array_filter($keys, fn($k) => $k !== $key));
        Cache::put($listKey, $keys, 86400);
    }
}
