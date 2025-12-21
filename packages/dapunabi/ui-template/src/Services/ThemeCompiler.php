<?php

namespace Dapunabi\UiTemplate\Services;

class ThemeCompiler
{
    public static function compileVuetify(array $tokens, bool $dark = false): array
    {
        $colors = self::extractColors($tokens);
        return [
            'defaultTheme' => 'tenant',
            'themes' => [
                'tenant' => [
                    'dark' => $dark,
                    'colors' => $colors,
                ],
            ],
        ];
    }

    public static function compileCssVariables(array $tokens): array
    {
        $vars = [];
        foreach ($tokens as $key => $value) {
            if (is_array($value)) continue;
            $varName = '--'.str_replace('_','-', strtolower($key));
            $vars[$varName] = (string) $value;
        }
        return $vars;
    }

    protected static function extractColors(array $tokens): array
    {
        // Map common token keys to Vuetify color keys
        $map = [
            'primary' => 'primary',
            'secondary' => 'secondary',
            'success' => 'success',
            'error' => 'error',
            'warning' => 'warning',
            'info' => 'info',
            'background' => 'background',
            'surface' => 'surface',
            'on_primary' => 'on-primary',
            'on_secondary' => 'on-secondary',
            'on_background' => 'on-background',
            'on_surface' => 'on-surface',
        ];
        $colors = [];
        foreach ($map as $from => $to) {
            if (isset($tokens[$from])) $colors[$to] = (string) $tokens[$from];
        }
        // Also include raw tokens that look like colors (#...)
        foreach ($tokens as $k => $v) {
            if (is_string($v) && preg_match('/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/', $v)) {
                $colors[str_replace('_','-', strtolower($k))] = $v;
            }
        }
        return $colors;
    }
}

