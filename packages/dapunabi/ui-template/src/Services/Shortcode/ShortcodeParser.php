<?php

namespace Dapunabi\UiTemplate\Services\Shortcode;

class ShortcodeParser
{
    public function __construct(protected ShortcodeRegistry $registry) {}

    public function parse(string $text, array $context = []): string
    {
        if ($text === '') {
            return $text;
        }
        $pattern = '/\[(\w+)([^\]]*)\](?:([\s\S]*?)\[\/\1\])?/m';
        return preg_replace_callback($pattern, function ($m) use ($context) {
            $tag = strtolower($m[1]);
            $attrStr = trim($m[2] ?? '');
            $inner = isset($m[3]) ? $m[3] : null;
            $attrs = $this->parseAttributes($attrStr);
            $handler = $this->registry->get($tag);
            if (! $handler) {
                return $m[0]; // leave unknown shortcode untouched
            }
            try {
                return $handler->render($attrs, $inner, $context);
            } catch (\Throwable $e) {
                return '<!-- shortcode error: '.htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8').' -->';
            }
        }, $text);
    }

    protected function parseAttributes(string $text): array
    {
        $attrs = [];
        // Matches key="value" or key='value' or key=value (unquoted)
        $pattern = '/(\w+)\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([^\s"\'=<>`]+))/';
        if (preg_match_all($pattern, $text, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $m) {
                $key = strtolower($m[1]);
                $val = $m[2] !== '' ? $m[2] : ($m[3] !== '' ? $m[3] : ($m[4] ?? ''));
                $attrs[$key] = $val;
            }
        }
        return $attrs;
    }
}

