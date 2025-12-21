<?php

namespace Dapunabi\UiTemplate\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Dapunabi\UiTemplate\Models\Page;
use Dapunabi\UiTemplate\Services\TemplateRenderer;

class PageRenderController extends BaseController
{
    public function show(Request $request, string $slug, TemplateRenderer $tr)
    {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $page = Page::query()
            ->when($tenantId, fn($q) => $q->where('tenant_id', $tenantId))
            ->where('slug', $slug)
            ->first();
        if (! $page) {
            abort(404);
        }
        $html = $tr->renderCached($page);
        return view('uitpl::page.show', compact('page','html'));
    }
}

