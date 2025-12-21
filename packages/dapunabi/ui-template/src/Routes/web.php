<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Admin + editor routes (protected)
    Route::middleware(['auth','tenant','license','seat','uitpl.can'])->group(function () {
        // Admin UI — Pages index
        Route::get('/admin/ui/pages', [\Dapunabi\UiTemplate\Http\Controllers\Admin\PageController::class, 'index'])
            ->name('uitpl.admin.pages');

        // Admin UI — Templates index
        Route::get('/admin/ui/templates', [\Dapunabi\UiTemplate\Http\Controllers\Admin\TemplateController::class, 'index'])
            ->name('uitpl.admin.templates');
        Route::get('/admin/ui/templates/import', function () {
            return view('uitpl::admin.templates.import');
        })->name('uitpl.admin.templates.import');
        Route::post('/admin/ui/templates/import', function () {
            request()->validate(['zip' => 'required|file|mimes:zip']);
            $tenantId = function_exists('tenant_id') ? tenant_id() : null;
            $path = request()->file('zip')->getRealPath();
            try {
                $res = app(\Dapunabi\UiTemplate\Services\Marketplace\TemplateImporter::class)->importZip($path, $tenantId ? (int)$tenantId : null);
                return back()->with('status', 'Imported: '.$res['template']['slug'].' (v'.($res['version'] ?? 'n/a').')');
            } catch (\Throwable $e) {
                return back()->withErrors(['zip' => $e->getMessage()]);
            }
        })->name('uitpl.admin.templates.import.store');

        // Admin UI — Theme editor
        Route::get('/admin/ui/theme', [\Dapunabi\UiTemplate\Http\Controllers\Admin\ThemeController::class, 'editor'])
            ->name('uitpl.admin.theme');
        Route::post('/admin/ui/theme', [\Dapunabi\UiTemplate\Http\Controllers\Admin\ThemeController::class, 'update'])
            ->name('uitpl.admin.theme.update');

        // Admin UI — Block registry
        Route::get('/admin/ui/blocks', [\Dapunabi\UiTemplate\Http\Controllers\Admin\BlockController::class, 'index'])
            ->name('uitpl.admin.blocks');
        Route::post('/admin/ui/blocks', [\Dapunabi\UiTemplate\Http\Controllers\Admin\BlockController::class, 'store'])
            ->name('uitpl.admin.blocks.store');

        // Visual Editor
        Route::get('/ui/editor', [\Dapunabi\UiTemplate\Http\Controllers\EditorController::class, 'index'])
            ->name('uitpl.editor');
        Route::post('/ui/editor/save', [\Dapunabi\UiTemplate\Http\Controllers\EditorController::class, 'save'])
            ->name('uitpl.editor.save');
        Route::post('/ui/editor/publish', [\Dapunabi\UiTemplate\Http\Controllers\EditorController::class, 'publish'])
            ->name('uitpl.editor.publish');
    });

    // API: get page by slug (public)
    Route::get('/api/v1/pages/{slug}', [\Dapunabi\UiTemplate\Http\Controllers\Api\PageApiController::class, 'show'])
        ->name('uitpl.api.page');

    // API: accessibility report for rendered page
    Route::get('/api/v1/pages/{slug}/a11y', function (\Illuminate\Http\Request $request, $slug) {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $locale = $request->query('locale','en');
        $repo = app(\Dapunabi\UiTemplate\Services\TemplateRepository::class);
        $page = $repo->pageBySlug($slug, $tenantId ? (int)$tenantId : null, $locale);
        if (! $page) return response()->json(['ok'=>false,'error'=>'Not found'],404);
        $tr = app(\Dapunabi\UiTemplate\Services\TemplateRenderer::class);
        $html = $tr->renderCached($page);
        $aud = app(\Dapunabi\UiTemplate\Services\AccessibilityAuditor::class);
        $warnings = $aud->analyzeHtml($html);
        return response()->json(['ok'=>true,'warnings'=>$warnings]);
    })->name('uitpl.api.page.a11y');

    // API: blocks registry (for editor UI)
    Route::get('/api/v1/ui/blocks', function () {
        try {
            return response()->json(app(\Dapunabi\UiTemplate\Services\BlockRegistry::class)->all());
        } catch (\Throwable $e) {
            return response()->json([]);
        }
    })->name('uitpl.api.blocks');

    // Public render
    Route::get('/p/{slug}', [\Dapunabi\UiTemplate\Http\Controllers\PageRenderController::class, 'show'])
        ->name('uitpl.page.render');

    // API: theme config for tenant
    Route::get('/api/v1/theme/config', [\Dapunabi\UiTemplate\Http\Controllers\Api\ThemeApiController::class, 'config'])
        ->name('uitpl.api.theme');
});
