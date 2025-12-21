<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Dapunabi\Media\Services\StorageManager;
use Dapunabi\Media\Models\Media;
use Dapunabi\Media\Models\MediaVersion;
use Dapunabi\Media\Models\MediaShare;
use Dapunabi\Media\Services\PresignService;
use Dapunabi\Media\Jobs\BulkZipJob;

// Determine optional permission middleware when CoreAuth is present
$mediaMw = ['web','auth'];
try {
    // If your app uses a permission middleware alias, you can add it by editing below
    // $mediaMw[] = 'permission:manage-media';
} catch (\Throwable $e) {}

Route::middleware($mediaMw)->group(function () {
    // Admin: basic media upload page (Phase 1)
    Route::get('/admin/media', function (Request $request) {
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $mediaTable = (new Media)->getTable();
        $hasTenantId = Schema::hasColumn($mediaTable, 'tenant_id');
        $q = Media::query()->when($tenantId && $hasTenantId, fn($qq)=>$qq->where('tenant_id',$tenantId));
        // Filters
        if ($request->filled('q')) {
            $term = '%'.$request->query('q').'%';
            $q->where(function($w) use ($term){
                $w->where('original_name','like',$term)->orWhere('filename','like',$term)->orWhere('path','like',$term);
            });
        }
        if ($request->filled('tag')) {
            $tag = $request->query('tag');
            // Try JSON contains; fallback to LIKE
            try { $q->whereJsonContains('tags_json', $tag); } catch (\Throwable $e) { $q->where('tags_json','like','%'.$tag.'%'); }
        }
        if ($request->filled('folder')) {
            $q->where('folder', $request->query('folder'));
        }
        if ($request->filled('type')) {
            $t = $request->query('type');
            if ($t==='image') $q->where('mime_type','like','image/%');
            elseif ($t==='pdf') $q->where('mime_type','application/pdf');
        }
        if ($request->filled('size_min')) $q->where('size','>=',(int)$request->integer('size_min'));
        if ($request->filled('size_max')) $q->where('size','<=',(int)$request->integer('size_max'));
        if ($request->filled('date_from')) $q->whereDate('created_at','>=',$request->query('date_from'));
        if ($request->filled('date_to')) $q->whereDate('created_at','<=',$request->query('date_to'));
        if ($request->filled('uploader')) $q->where('uploaded_by',(int)$request->integer('uploader'));

        $items = $q->orderByDesc('id')->paginate(24)->withQueryString();
        return view('media::admin.index', compact('items'));
    })->name('media.admin.index');

    Route::get('/admin/media/upload', function () {
        return view('media::admin.upload');
    })->name('media.admin.upload');

    Route::post('/admin/media/upload', function (Request $request) {
        try { if (Gate::has('manage-media') && Gate::denies('manage-media')) abort(403); } catch (\Throwable $e) {}
        $request->validate(['file' => 'required|file|max:'.(config('media-manager.max_upload_mb')*1024)]);
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $mgr = app(StorageManager::class);
        try {
            $res = $mgr->storeUploadedFile($request->file('file'), $tenantId, auth()->id());
        } catch (\Dapunabi\Media\Exceptions\QuotaExceededException $qe) {
            return back()->withErrors(['file' => $qe->getMessage()]);
        }
        return redirect()->route('media.admin.index')->with('status', 'Uploaded: '.$res->original_name);
    })->name('media.admin.upload.post');

    // Detail & replace
    Route::get('/admin/media/{id}', function ($id) {
        $m = Media::findOrFail($id);
        $versions = MediaVersion::where('media_id',$m->id)->orderByDesc('version_no')->get();
        $shares = MediaShare::where('media_id', $m->id)->orderByDesc('id')->get();
        return view('media::admin.show', compact('m','versions','shares'));
    })->name('media.admin.show');

    Route::post('/admin/media/{id}/replace', function ($id, Request $request) {
        try { if (Gate::has('manage-media') && Gate::denies('manage-media')) abort(403); } catch (\Throwable $e) {}
        $request->validate(['file' => 'required|file|max:'.(config('media-manager.max_upload_mb')*1024)]);
        $m = Media::findOrFail($id);
        // persist previous version
        MediaVersion::create([
            'media_id' => $m->id,
            'version_no' => $m->version,
            'disk' => $m->disk,
            'path' => $m->path,
            'size' => $m->size,
            'mime_type' => $m->mime_type,
            'filename' => $m->filename,
            'original_name' => $m->original_name,
            'uploaded_by' => $m->uploaded_by,
        ]);
        // store new
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $mgr = app(StorageManager::class);
        $new = $mgr->storeUploadedFile($request->file('file'), $tenantId, auth()->id());
        // update current media to new path/info
        $m->version = $m->version + 1;
        $m->disk = $new->disk;
        $m->path = $new->path;
        $m->size = $new->size;
        $m->mime_type = $new->mime_type;
        $m->filename = $new->filename;
        $m->original_name = $new->original_name;
        $m->hash = $new->hash;
        $m->uploaded_by = $new->uploaded_by;
        $m->variants_json = [];
        $m->save();
        try { $new->delete(); } catch (\Throwable $e) {}
        return redirect()->route('media.admin.show', ['id'=>$m->id])->with('status','Replaced. New version '.$m->version);
    })->name('media.admin.replace');

    // Update visibility
    Route::post('/admin/media/{id}/visibility', function ($id, Request $request) {
        try { if (Gate::has('manage-media') && Gate::denies('manage-media')) abort(403); } catch (\Throwable $e) {}
        $request->validate(['visibility' => 'required|in:private,public,shared']);
        $m = Media::findOrFail($id);
        $m->visibility = $request->string('visibility');
        $m->save();
        return back()->with('status','Visibility updated');
    })->name('media.admin.visibility');

    // Create new share token
    Route::post('/admin/media/{id}/share', function ($id, Request $request) {
        try { if (Gate::has('manage-media') && Gate::denies('manage-media')) abort(403); } catch (\Throwable $e) {}
        $m = Media::findOrFail($id);
        $ttl = max(60, (int) $request->integer('ttl', config('media-manager.share_ttl_default', 86400)));
        $token = bin2hex(random_bytes(16));
        $share = MediaShare::create([
            'media_id' => $m->id,
            'token' => $token,
            'expires_at' => now()->addSeconds($ttl),
            'downloads_count' => 0,
            'created_by' => auth()->id(),
        ]);
        // If visibility set to shared, keep; otherwise leave as-is
        return back()->with('status','Share link created: '.url('/media/share/'.$token));
    })->name('media.admin.share');

    // Revoke share token
    Route::post('/admin/media/{id}/share/{token}/revoke', function ($id, $token) {
        try { if (Gate::has('manage-media') && Gate::denies('manage-media')) abort(403); } catch (\Throwable $e) {}
        $m = Media::findOrFail($id);
        MediaShare::where('media_id',$m->id)->where('token',$token)->delete();
        return back()->with('status','Share revoked');
    })->name('media.admin.share.revoke');

    // Assign tags and folder
    Route::post('/admin/media/{id}/tags', function ($id, Request $request) {
        $m = Media::findOrFail($id);
        $tags = array_values(array_filter(array_map(fn($t)=>trim($t), explode(',', (string)$request->input('tags','')))));
        $m->tags_json = $tags;
        $m->save();
        return back()->with('status','Tags updated');
    })->name('media.admin.tags');

    Route::post('/admin/media/{id}/move', function ($id, Request $request) {
        $m = Media::findOrFail($id);
        $m->folder = trim((string)$request->input('folder')) ?: null;
        $m->save();
        return back()->with('status','Moved to folder');
    })->name('media.admin.move');

    // Bulk operations: zip, delete, tag, move
    Route::post('/admin/media/bulk', function (Request $request) {
        $ids = collect((array) $request->input('ids', []))->map(fn($v)=>(int)$v)->filter()->values()->all();
        abort_if(empty($ids), 400, 'No selection');
        $action = $request->input('action');
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        if ($action === 'zip') {
            BulkZipJob::dispatch($tenantId, $ids, auth()->id());
            return back()->with('status','Bulk zip started. A ZIP will appear in the library once ready.');
        }
        if ($action === 'delete') {
            $items = Media::whereIn('id',$ids)->get();
            foreach ($items as $m) {
                try { Storage::disk($m->disk)->delete($m->path); } catch (\Throwable $e) {}
                try { \DB::table(config('media-manager.tables.variants','mm_media_variants'))->where('media_id',$m->id)->delete(); } catch (\Throwable $e) {}
                try { \DB::table(config('media-manager.tables.shares','mm_media_shares'))->where('media_id',$m->id)->delete(); } catch (\Throwable $e) {}
                try { $m->delete(); event(new \Dapunabi\Media\Events\MediaDeleted($m->id)); } catch (\Throwable $e) {}
            }
            return back()->with('status','Deleted '.count($items).' items.');
        }
        if ($action === 'tag') {
            $tags = array_values(array_filter(array_map(fn($t)=>trim($t), explode(',', (string)$request->input('tags','')))));
            Media::whereIn('id',$ids)->update(['tags_json' => $tags]);
            return back()->with('status','Tags updated on '.count($ids).' items.');
        }
        if ($action === 'move') {
            $folder = trim((string)$request->input('folder')) ?: null;
            Media::whereIn('id',$ids)->update(['folder' => $folder]);
            return back()->with('status','Moved '.count($ids).' items.');
        }
        abort(400, 'Unknown action');
    })->name('media.admin.bulk');

    // Duplicates screen
    Route::get('/admin/media/duplicates', function (Request $request) {
        $scope = $request->query('scope', config('media-manager.dedupe_scope','tenant'));
        $tenantId = function_exists('tenant_id') ? tenant_id() : null;
        $q = Media::query()->selectRaw('hash, COUNT(*) as cnt, MIN(id) as any_id')
            ->whereNotNull('hash')
            ->groupBy('hash')
            ->havingRaw('COUNT(*) > 1');
        if ($scope === 'tenant' && $tenantId) {
            $q->where('tenant_id', $tenantId);
        }
        $groups = $q->orderByDesc('cnt')->limit(100)->get();
        $byHash = [];
        foreach ($groups as $g) {
            $byHash[$g->hash] = Media::where('hash',$g->hash)
                ->when($scope==='tenant' && $tenantId, fn($w)=>$w->where('tenant_id',$tenantId))
                ->orderByDesc('id')->get();
        }
        return view('media::admin.duplicates', compact('byHash','scope'));
    })->name('media.admin.duplicates');
});

// Public share endpoint (no auth)
Route::middleware(['web'])->get('/media/share/{token}', function ($token, PresignService $svc) {
    $share = MediaShare::where('token',$token)->first();
    abort_if(!$share, 404);
    if ($share->expires_at && now()->greaterThan($share->expires_at)) {
        abort(410, 'Share expired');
    }
    $media = Media::findOrFail($share->media_id);
    // Only allow if visibility allows shared or private with explicit token
    if (!in_array($media->visibility, ['shared','public','private'])) {
        abort(403);
    }
    $disk = $media->disk ?: config('media-manager.disk','public');
    // Prefer signed download for S3/private
    $url = $svc->downloadUrl($disk, $media->path, (int) config('media-manager.download_ttl', 900));
    // count download
    try { $share->increment('downloads_count'); } catch (\Throwable $e) {}
    return redirect()->away($url);
})->name('media.share.open');
