<?php

namespace Dapunabi\UiTemplate\Services;

class AccessibilityAuditor
{
    public function analyzeHtml(string $html): array
    {
        $warnings = [];

        // img without alt
        if (preg_match_all('/<img\b[^>]*>/i', $html, $imgs)) {
            foreach ($imgs[0] as $img) {
                if (! preg_match('/\balt\s*=\s*("[^"]*"|'."'[^']*'|[^\s>]+)/i", $img)) {
                    $warnings[] = 'Image tag missing alt attribute: '.$this->truncate($img);
                }
            }
        }

        // links with empty text
        if (preg_match_all('/<a\b[^>]*>(.*?)<\/a>/is', $html, $links)) {
            foreach ($links[1] as $i => $inner) {
                $txt = trim(strip_tags($inner));
                if ($txt === '') {
                    $warnings[] = 'Link with empty text: '.$this->truncate($links[0][$i]);
                }
            }
        }

        // buttons with empty text
        if (preg_match_all('/<button\b[^>]*>(.*?)<\/button>/is', $html, $btns)) {
            foreach ($btns[1] as $i => $inner) {
                $txt = trim(strip_tags($inner));
                if ($txt === '') {
                    $warnings[] = 'Button with empty text: '.$this->truncate($btns[0][$i]);
                }
            }
        }

        // naive contrast check: same color and background inline CSS
        if (preg_match_all('/style=\"([^\"]*)\"/i', $html, $styles)) {
            foreach ($styles[1] as $style) {
                $color = $this->extractCssValue($style, 'color');
                $bg = $this->extractCssValue($style, 'background-color');
                if ($color && $bg && strtolower($color) === strtolower($bg)) {
                    $warnings[] = 'Low contrast: color equals background-color ('.$color.').';
                }
            }
        }

        return $warnings;
    }

    protected function extractCssValue(string $style, string $prop): ?string
    {
        if (preg_match('/'.preg_quote($prop,'/').'\s*:\s*([^;]+)/i', $style, $m)) {
            return trim($m[1]);
        }
        return null;
    }

    protected function truncate(string $s, int $len = 80): string
    {
        $s = strip_tags($s);
        $s = preg_replace('/\s+/', ' ', $s);
        return mb_strlen($s) > $len ? (mb_substr($s, 0, $len-3).'...') : $s;
    }
}

