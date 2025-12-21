<?php

namespace Dapunabi\UiTemplate\Services\Shortcode\Handlers;

use Dapunabi\UiTemplate\Services\Shortcode\ShortcodeInterface;

class CTAHandler implements ShortcodeInterface
{
    public function render(array $attrs = [], ?string $content = null, array $context = []): string
    {
        $text = $attrs['text'] ?? ($content ?? 'Call to Action');
        $url = $attrs['url'] ?? '#';
        $class = $attrs['class'] ?? 'btn btn-primary';
        $t = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $u = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $c = htmlspecialchars($class, ENT_QUOTES, 'UTF-8');
        return "<a href=\"{$u}\" class=\"{$c}\">{$t}</a>";
    }
}
