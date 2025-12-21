<?php

namespace Dapunabi\UiTemplate\Services\Shortcode\Handlers;

use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeInterface;

class LatestPostsHandler implements ShortcodeInterface
{
    public function render(array $attrs = [], ?string $content = null, array $context = []): string
    {
        $count = max(1, (int)($attrs['count'] ?? 5));
        $tenantId = $context['tenant_id'] ?? (function_exists('tenant_id') ? tenant_id() : null);
        $items = [];
        try {
            if (class_exists('Dapunjabi\\TenancyAdapter\\Models\\Post')) {
                $q = \Dapunjabi\TenancyAdapter\Models\Post::query()->orderByDesc('id');
                if ($tenantId) $q->where('tenant_id', $tenantId);
                $items = $q->limit($count)->get(['title'])->pluck('title')->all();
            }
        } catch (\Throwable $e) {}
        if (empty($items)) {
            $items = [ 'Sample Post A', 'Sample Post B' ];
        }
        $lis = array_map(fn($t) => '<li>'.htmlspecialchars($t, ENT_QUOTES, 'UTF-8').'</li>', $items);
        return '<ul class="uitpl-latest-posts">'.implode('', $lis).'</ul>';
    }
}
