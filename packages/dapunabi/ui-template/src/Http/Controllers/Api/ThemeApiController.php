<?php

namespace Dapunabi\UiTemplate\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Dapunabi\UiTemplate\Models\Theme;
use Dapunabi\UiTemplate\Services\ThemeCompiler;

class ThemeApiController extends BaseController
{
    public function config()
    {
        $tenant = function_exists('currentTenant') ? currentTenant() : null;
        $presets = (array) config('ui-template.theme_presets', []);
        $presetKey = null;
        try {
            $presetKey = data_get($tenant?->settings, 'theme.preset') ?: data_get($tenant?->settings, 'theme_preset');
        } catch (\Throwable $e) {}

        $tokens = $presets[$presetKey] ?? $presets['default'] ?? [
            'primary' => '#1976D2',
            'secondary' => '#10b981',
        ];

        // Priority: explicit Theme model → tenant.settings.theme → defaults
        try {
            $tenantId = $tenant?->id;
            if ($tenantId) {
                $row = Theme::where('tenant_id', $tenantId)->first();
                if ($row && is_array($row->tokens)) {
                    $tokens = array_merge($tokens, $row->tokens);
                } elseif (isset($tenant->settings['theme'])) {
                    $themeTokens = (array) $tenant->settings['theme'];
                    unset($themeTokens['preset']);
                    $tokens = array_merge($tokens, $themeTokens);
                }
            }
        } catch (\Throwable $e) {}

        $vuetify = ThemeCompiler::compileVuetify($tokens, false);
        $cssVars = ThemeCompiler::compileCssVariables($tokens);

        return response()->json([
            'tenant' => $tenant?->only(['id','slug','name']) ?? null,
            'tokens' => $tokens,
            'vuetify' => $vuetify,
            'css_variables' => $cssVars,
            'generated_at' => now()->toISOString(),
        ]);
    }
}
