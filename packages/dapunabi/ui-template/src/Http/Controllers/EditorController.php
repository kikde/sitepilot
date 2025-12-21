<?php

namespace Dapunabi\UiTemplate\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dapunabi\UiTemplate\Models\Page;
use Dapunabi\UiTemplate\Services\TemplateRepository;
use Dapunabi\UiTemplate\Services\BlockRegistry;

class EditorController extends BaseController
{
    public function index(Request $request)
    {
        $slug = $request->query('slug', 'home');
        $locale = $request->query('locale', 'en');
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $repo = app(TemplateRepository::class);
        $page = $repo->pageBySlug($slug, $tenantId ? (int)$tenantId : null, $locale);
        if (! $page) {
            $page = Page::create([
                'tenant_id' => $tenantId,
                'slug' => $slug,
                'locale' => $locale,
                'title' => ucfirst($slug),
                'data' => ['blocks' => []],
                'published' => false,
            ]);
        }
        $content = is_array($page->data) ? ($page->data) : ['blocks' => []];
        $blocks = app(BlockRegistry::class)->all();
        return view('uitpl::editor.index', [
            'slug' => $slug,
            'locale' => $page->locale ?? $locale,
            'page' => $page,
            'content' => $content,
            'manifests' => $blocks,
        ]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string',
            'content_json' => 'required|string',
            'locale' => 'nullable|string|max:10',
        ]);
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $repo = app(TemplateRepository::class);
        $page = $repo->pageBySlug($validated['slug'], $tenantId ? (int)$tenantId : null, $validated['locale'] ?? 'en');
        if (! $page) {
            abort(404);
        }
        $payload = json_decode($validated['content_json'], true);
        if (! is_array($payload)) {
            return response()->json(['ok' => false, 'error' => 'Invalid content_json'], 422);
        }
        $page->data = $payload;
        $page->save();
        // Create revision in ui_revisions
        try {
            DB::table('ui_revisions')->insert([
                'tenant_id' => $tenantId,
                'entity_type' => 'page',
                'entity_id' => $page->id,
                'payload' => json_encode($payload),
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {}
        try {
            $tenantIdInt = (int) ($tenantId ?? 0);
            app(\Dapunabi\UiTemplate\Services\TemplateRenderer::class)->invalidate($tenantIdInt, (string) $page->slug);
        } catch (\Throwable $e) {}
        return response()->json(['ok' => true]);
    }

    public function publish(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string',
            'content_json' => 'required|string',
            'locale' => 'nullable|string|max:10',
        ]);
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $repo = app(TemplateRepository::class);
        $page = $repo->pageBySlug($validated['slug'], $tenantId ? (int)$tenantId : null, $validated['locale'] ?? 'en');
        if (! $page) {
            abort(404);
        }
        $payload = json_decode($validated['content_json'], true);
        if (! is_array($payload)) {
            return response()->json(['ok' => false, 'error' => 'Invalid content_json'], 422);
        }
        $page->data = $payload;
        $page->published = true;
        $page->save();
        try {
            DB::table('ui_revisions')->insert([
                'tenant_id' => $tenantId,
                'entity_type' => 'page',
                'entity_id' => $page->id,
                'payload' => json_encode($payload),
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {}
        try {
            $tenantIdInt = (int) ($tenantId ?? 0);
            app(\Dapunabi\UiTemplate\Services\TemplateRenderer::class)->invalidate($tenantIdInt, (string) $page->slug);
        } catch (\Throwable $e) {}
        return response()->json(['ok' => true, 'published' => true]);
    }
}
