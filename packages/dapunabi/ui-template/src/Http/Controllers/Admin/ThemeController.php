<?php

namespace Dapunabi\UiTemplate\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Dapunabi\UiTemplate\Models\Theme;
use Dapunabi\UiTemplate\Services\ThemeCompiler;

class ThemeController extends BaseController
{
    public function editor()
    {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $row = $tenantId ? Theme::firstOrNew(['tenant_id' => $tenantId]) : new Theme();
        $tokens = $row->tokens ?: [
            'primary' => '#1976D2',
            'secondary' => '#10b981',
        ];
        $cssVars = ThemeCompiler::compileCssVariables($tokens);
        return view('uitpl::admin.theme.editor', compact('tokens','cssVars','tenantId'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tokens' => 'required|string',
        ]);
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $data = json_decode($request->input('tokens'), true);
        if (! is_array($data)) {
            return back()->withErrors(['tokens' => 'Invalid JSON tokens']);
        }
        if ($tenantId) {
            $row = Theme::firstOrNew(['tenant_id' => $tenantId]);
            $row->tokens = $data;
            $row->save();
        }
        return back()->with('status', 'Theme updated');
    }
}

