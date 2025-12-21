<?php

namespace Dapunjabi\TenancyAdapter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class TenantMediaController extends Controller
{
    public function index()
    {
        $tenant = currentTenant();
        $usedMb = tenant_storage_usage_mb($tenant);
        $quotaMb = (int) data_get($tenant, 'settings.quotas.storage_quota_mb', 0);
        return view('tenancy::tenant.media', compact('tenant', 'usedMb', 'quotaMb'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:51200', // up to 50MB per file
        ]);
        $tenant = currentTenant();
        $pathPrefix = 'tenant-uploads/'.tenant_id();
        $path = $request->file('file')->store($pathPrefix, 'public');
        $url = Storage::disk('public')->url($path);
        return redirect()->route('tenancy.media.index')->with('status', 'Uploaded: '.$url);
    }
}

