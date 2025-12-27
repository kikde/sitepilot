<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomeSectionController extends Controller
{
    private function tenantId(): ?int
    {
        try {
            if (function_exists('tenant_id')) {
                $id = tenant_id();
                return $id ? (int) $id : null;
            }
        } catch (\Throwable $e) {
        }
        return null;
    }

    private function ensureTenantClone(string $table): void
    {
        $tenantId = $this->tenantId();
        if (!$tenantId) {
            return;
        }
        if (!Schema::hasTable($table)) {
            return;
        }
        if (!Schema::hasColumn($table, 'tenant_id')) {
            return;
        }

        $hasTenantRows = DB::table($table)->where('tenant_id', $tenantId)->exists();
        if ($hasTenantRows) {
            return;
        }

        $templateRows = DB::table($table)->whereNull('tenant_id')->get();
        if ($templateRows->isEmpty()) {
            return;
        }

        foreach ($templateRows as $row) {
            $data = (array) $row;
            unset($data['id']);
            $data['tenant_id'] = $tenantId;
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table($table)->insert($data);
        }
    }

    public function bannerList()
    {
        $this->ensureTenantClone('home_banners');
        $tenantId = $this->tenantId();

        $q = DB::table('home_banners')->orderByDesc('id');
        if ($tenantId && Schema::hasColumn('home_banners', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $rows = $q->paginate(10);
        // Prefer the JCF banner index view if present; fallback to module view
        $altPath = base_path('jcf/resources/views/backend/home-page-manage/banner/index.blade.php');
        if (is_file($altPath)) {
            // JCF blade expects variable name `$banner`
            $banner = $rows;
            return \View::file($altPath, compact('banner'));
        }
        return view('page::home.banner-list', compact('rows'));
    }

    public function bannerStore(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string|max:255',
            'alt_tag' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
        ]);

        $tenantId = $this->tenantId();
        $data = $request->only(['title','images','alt_tag','meta_title','meta_tag','meta_keywords','meta_description','status']);
        $data['user_id'] = (int) Auth::id();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        if ($tenantId && Schema::hasColumn('home_banners', 'tenant_id')) {
            $data['tenant_id'] = $tenantId;
        }

        DB::table('home_banners')->insert($data);
        return back()->with('message', 'Banner added successfully');
    }

    public function bannerUpdate(Request $request, int $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string|max:255',
            'alt_tag' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
        ]);

        $tenantId = $this->tenantId();
        $q = DB::table('home_banners')->where('id', $id);
        if ($tenantId && Schema::hasColumn('home_banners', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $q->update(array_merge(
            $request->only(['title','images','alt_tag','meta_title','meta_tag','meta_keywords','meta_description','status']),
            ['updated_at' => now(), 'user_id' => (int) Auth::id()]
        ));

        return back()->with('message', 'Banner updated successfully');
    }

    public function bannerDestroy(int $id)
    {
        $tenantId = $this->tenantId();
        $q = DB::table('home_banners')->where('id', $id);
        if ($tenantId && Schema::hasColumn('home_banners', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $q->delete();
        return back()->with('message', 'Banner deleted successfully');
    }

    public function whatToDoList()
    {
        $this->ensureTenantClone('home_todos');
        $tenantId = $this->tenantId();

        $q = DB::table('home_todos')->orderByDesc('id');
        if ($tenantId && Schema::hasColumn('home_todos', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $rows = $q->paginate(10);
        return view('page::home.what-to-do-list', compact('rows'));
    }

    public function whatToDoStore(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string|max:255',
            'alt_tag' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
        ]);

        $tenantId = $this->tenantId();
        $data = $request->only(['title','images','alt_tag','description','status']);
        $data['user_id'] = (int) Auth::id();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        if ($tenantId && Schema::hasColumn('home_todos', 'tenant_id')) {
            $data['tenant_id'] = $tenantId;
        }
        DB::table('home_todos')->insert($data);
        return back()->with('message', 'What-to-do item added successfully');
    }

    public function whatToDoUpdate(Request $request, int $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string|max:255',
            'alt_tag' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
        ]);

        $tenantId = $this->tenantId();
        $q = DB::table('home_todos')->where('id', $id);
        if ($tenantId && Schema::hasColumn('home_todos', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $q->update(array_merge(
            $request->only(['title','images','alt_tag','description','status']),
            ['updated_at' => now(), 'user_id' => (int) Auth::id()]
        ));
        return back()->with('message', 'What-to-do item updated successfully');
    }

    public function whatToDoDestroy(int $id)
    {
        $tenantId = $this->tenantId();
        $q = DB::table('home_todos')->where('id', $id);
        if ($tenantId && Schema::hasColumn('home_todos', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $q->delete();
        return back()->with('message', 'What-to-do item deleted successfully');
    }

    public function staticSection()
    {
        $this->ensureTenantClone('home_award_static');
        $tenantId = $this->tenantId();

        $q = DB::table('home_award_static');
        if ($tenantId && Schema::hasColumn('home_award_static', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $row = $q->first();

        return view('page::home.static-section', compact('row'));
    }

    public function staticSectionUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string',
            'background' => 'nullable|string|max:255',
        ]);

        $tenantId = $this->tenantId();
        $data = $request->only(['heading','subheading','background']);
        $data['updated_at'] = now();
        $data['user_id'] = (int) Auth::id();

        $q = DB::table('home_award_static');
        if ($tenantId && Schema::hasColumn('home_award_static', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
            $exists = DB::table('home_award_static')->where('tenant_id', $tenantId)->exists();
            if (!$exists) {
                $data['tenant_id'] = $tenantId;
                $data['created_at'] = now();
                DB::table('home_award_static')->insert($data);
                return back()->with('message', 'Static section saved successfully');
            }
        }

        $q->limit(1)->update($data);
        return back()->with('message', 'Static section updated successfully');
    }

    public function awardSection()
    {
        $this->ensureTenantClone('home_award_section');
        $tenantId = $this->tenantId();

        $q = DB::table('home_award_section')->orderByDesc('id');
        if ($tenantId && Schema::hasColumn('home_award_section', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $rows = $q->paginate(10);
        return view('page::home.award-section', compact('rows'));
    }

    public function awardSectionStore(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string|max:255',
            'alt_tag' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
        ]);

        $tenantId = $this->tenantId();
        $data = $request->only(['title','images','alt_tag','description','status']);
        $data['user_id'] = (int) Auth::id();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        if ($tenantId && Schema::hasColumn('home_award_section', 'tenant_id')) {
            $data['tenant_id'] = $tenantId;
        }
        DB::table('home_award_section')->insert($data);
        return back()->with('message', 'Award item added successfully');
    }

    public function awardSectionUpdate(Request $request, int $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string|max:255',
            'alt_tag' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
        ]);

        $tenantId = $this->tenantId();
        $q = DB::table('home_award_section')->where('id', $id);
        if ($tenantId && Schema::hasColumn('home_award_section', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $q->update(array_merge(
            $request->only(['title','images','alt_tag','description','status']),
            ['updated_at' => now(), 'user_id' => (int) Auth::id()]
        ));
        return back()->with('message', 'Award item updated successfully');
    }

    public function awardSectionDestroy(int $id)
    {
        $tenantId = $this->tenantId();
        $q = DB::table('home_award_section')->where('id', $id);
        if ($tenantId && Schema::hasColumn('home_award_section', 'tenant_id')) {
            $q->where('tenant_id', $tenantId);
        }
        $q->delete();
        return back()->with('message', 'Award item deleted successfully');
    }
}
