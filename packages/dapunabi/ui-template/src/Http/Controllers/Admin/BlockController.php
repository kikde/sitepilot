<?php

namespace Dapunabi\UiTemplate\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Dapunabi\UiTemplate\Models\Block;

class BlockController extends BaseController
{
    public function index()
    {
        $blocks = Block::orderBy('code')->get();
        return view('uitpl::admin.blocks.index', compact('blocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'manifest' => 'required|string',
        ]);
        $data = json_decode($request->input('manifest'), true);
        if (! is_array($data)) {
            return back()->withErrors(['manifest' => 'Invalid JSON manifest']);
        }
        $key = $data['key'] ?? $data['code'] ?? null;
        $name = $data['name'] ?? null;
        $fields = $data['fields'] ?? $data['schema'] ?? [];
        if (! $key || ! $name || ! is_array($fields)) {
            return back()->withErrors(['manifest' => 'Manifest must include key, name, and fields object']);
        }
        $defaults = $data['defaults'] ?? [];
        $component = $data['component'] ?? null;
        $preview = $data['preview'] ?? null;
        $category = $data['category'] ?? null;
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;

        Block::updateOrCreate([
            'code' => $key,
            'tenant_id' => $tenantId,
        ], [
            'name' => $name,
            'schema' => $fields,
            'defaults' => $defaults,
            'component' => $component,
            'preview' => $preview,
            'category' => $category,
            'active' => true,
        ]);

        // refresh registry singleton
        try { app(\Dapunabi\UiTemplate\Services\BlockRegistry::class)->load(); } catch (\Throwable $e) {}

        return back()->with('status', 'Block manifest saved');
    }
}

