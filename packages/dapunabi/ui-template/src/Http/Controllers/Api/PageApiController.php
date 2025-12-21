<?php

namespace Dapunabi\UiTemplate\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PageApiController extends BaseController
{
    public function show(Request $request, string $slug)
    {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $locale = $request->query('locale', 'en');
        $repo = app(\Dapunabi\UiTemplate\Services\TemplateRepository::class);
        $pageModel = $repo->pageBySlug($slug, $tenantId ? (int)$tenantId : null, $locale);
        if (! $pageModel) {
            return response()->json(['ok' => false, 'error' => 'Not found'], 404);
        }
        $tr = app(\Dapunabi\UiTemplate\Services\TemplateRenderer::class);
        $html = $tr->renderCached($pageModel);
        return response()->json([
            'ok' => true,
            'slug' => $slug,
            'tenant_id' => $tenantId,
            'locale' => $pageModel->locale,
            'published' => (bool) $pageModel->published,
            'html' => $html,
        ]);
    }
}
