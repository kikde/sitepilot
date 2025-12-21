<?php

namespace Dapunabi\UiTemplate\Services;

use Dapunabi\UiTemplate\Models\Page;
use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeParser;

class Renderer
{
    public function __construct(
        protected BlockRegistry $blocks,
        protected ShortcodeParser $shortcodes,
    ) {}

    public function renderPage(Page $page): string
    {
        $data = is_array($page->data) ? $page->data : [];
        $html = '';
        $ctx = [
            'tenant_id' => $page->tenant_id ?? (function_exists('tenant_id') ? tenant_id() : null),
            'page' => $page,
            'request' => request(),
            'locale' => method_exists($page, '__get') ? ($page->locale ?? request()->query('locale')) : request()->query('locale'),
        ];
        foreach (($data['blocks'] ?? []) as $block) {
            $html .= $this->renderBlock($block, $ctx);
        }
        return $html;
    }

    protected function renderBlock(array $block, array $ctx): string
    {
        $key = $block['key'] ?? 'unknown';
        $props = $block['props'] ?? [];
        // Simple built-ins for demo blocks
        switch ($key) {
            case 'hero':
                $title = $this->sc($props['title'] ?? '', $ctx);
                $subtitle = $this->sc($props['subtitle'] ?? '', $ctx);
                $ctaText = $this->sc($props['cta_text'] ?? '', $ctx);
                $ctaUrl = htmlspecialchars((string)($props['cta_url'] ?? '#'), ENT_QUOTES, 'UTF-8');
                return "<section class=\"uitpl-hero p-4 bg-light\"><h1>{$title}</h1><p>{$subtitle}</p>".
                       ($ctaText ? "<p><a href=\"{$ctaUrl}\" class=\"btn btn-primary\">{$ctaText}</a></p>" : '').
                       "</section>";
            case 'features':
                $items = $props['items'] ?? [];
                $lis = '';
                foreach ($items as $it) {
                    $t = $this->sc($it['title'] ?? '', $ctx);
                    $txt = $this->sc($it['text'] ?? '', $ctx);
                    $lis .= "<li><strong>{$t}</strong><br><span>{$txt}</span></li>";
                }
                return "<section class=\"uitpl-features p-3\"><ul>{$lis}</ul></section>";
            case 'footer':
                $copy = $this->sc($props['copyright'] ?? '', $ctx);
                return "<footer class=\"uitpl-footer text-center p-3 text-muted\">{$copy}</footer>";
            default:
                // Fallback: try manifest preview, then generic
                $man = $this->blocks->get($key) ?? [];
                if (!empty($man['preview'])) {
                    return $this->sc((string)$man['preview'], $ctx);
                }
                $code = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
                return "<section class=\"uitpl-block p-2 border\"><em>{$code}</em></section>";
        }
    }

    protected function sc(string $text, array $ctx): string
    {
        return $this->shortcodes->parse($text, $ctx);
    }
}
