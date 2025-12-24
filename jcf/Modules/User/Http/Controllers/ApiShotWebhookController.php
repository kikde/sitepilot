<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use App\Models\Payment;

class ApiShotWebhookController extends Controller
{
    /**
     * Handle webhook callbacks from APIshot.
     */
    public function handle(Request $req)
    {
        Log::info('APISHOT.WEBHOOK_IN', ['all' => $req->all()]);

        $jobId  = $req->input('id') ?? $req->input('job.id') ?? $req->input('job_id');
        $status = $req->input('status') ?? $req->input('job.status');

        $fileUrl = $req->input('result_url') ?? $req->input('file') ?? $req->input('url');

        if (!$jobId) {
            Log::warning('APISHOT.WEBHOOK_MISSING_ID', ['payload' => $req->all()]);
            return response()->json(['ok' => false, 'error' => 'missing_id'], 400);
        }

        if ($status && !in_array($status, ['succeeded','success','done','completed'], true)) {
            Log::info('APISHOT.WEBHOOK_IGNORE_STATUS', compact('jobId','status'));
            return response()->json(['ok' => true]);
        }

        $meta   = $req->input('meta', []);
        if (empty($meta)) {
            $meta = $req->input('datasinkMeta', []);
        }

        $userId = (int)($meta['user_id'] ?? $req->input('user_id'));
        $kind   = $meta['kind']    ?? $req->input('kind');
        $suggest= $meta['suggest'] ?? $req->input('suggested_filename');

     // NEW: derive from the known render pages if meta is missing
if ((!$userId || !$kind) && $req->filled('url')) {
    $srcPath = parse_url($req->input('url'), PHP_URL_PATH) ?: '';
$src = strtolower($srcPath ?? '');
    if (preg_match('~/documents/affidavit/(\d+)(?:/)?$~', $src, $m)) {
    $kind   = $kind   ?: 'affidavit';
    $userId = $userId ?: (int) $m[1];
    Log::info('APISHOT.WEBHOOK_AFFIDAVIT_MATCH', ['srcPath' => $srcPath, 'userId' => $userId, 'kind' => $kind]);
}
    // /idcard/{id}
    if (preg_match('~/(idcard)/(\d+)(?:/)?$~', $srcPath, $m)) {
        $kind   = $kind   ?: 'idcard';
        $userId = $userId ?: (int)$m[2];
    }

    // /joining-letter/{id}  -> appointment_letter column
    if (preg_match('~/(joining-letter)/(\d+)(?:/)?$~', $srcPath, $m)) {
        $kind   = $kind   ?: 'joining_letter';
        $userId = $userId ?: (int)$m[2];
    }

    // /off1-letter/{id}
    if (preg_match('~/(off1-letter)/(\d+)(?:/)?$~', $srcPath, $m)) {
        $kind   = $kind   ?: 'official_1';
        $userId = $userId ?: (int)$m[2];
    }

    // /off2-letter/{id}
    if (preg_match('~/(off2-letter)/(\d+)(?:/)?$~', $srcPath, $m)) {
        $kind   = $kind   ?: 'official_2';
        $userId = $userId ?: (int)$m[2];
    }

    // /honor-letter/{id}  -> honar_letter column (db spelling)
    if (preg_match('~/(honor-letter)/(\d+)(?:/)?$~', $srcPath, $m)) {
        $kind   = $kind   ?: 'honor_letter';
        $userId = $userId ?: (int)$m[2];
    }

      if (preg_match('~/(payment-receipt)/(\d+)(?:/)?$~', $srcPath, $m)) {
        $kind   = $kind   ?: 'payment_receipt';
        $userId = $userId ?: (int)$m[2];
    }
}

        if (!$fileUrl && $req->filled('local_path')) {
            $localPath = (string)$req->input('local_path');
            $apiBase   = rtrim(config('member.apishot.base') ?? env('APISHOT_BASE',''), '/');
            if ($apiBase) {
                $filename = basename($localPath);
                $dirnum   = basename(dirname($localPath));
                $fileUrl  = $apiBase . '/storage/' . $dirnum . '/' . $filename;
                Log::info('APISHOT.WEBHOOK_DERIVED_URL', ['fileUrl' => $fileUrl]);
            }
        }

        if (!$fileUrl) {
            Log::warning('APISHOT.WEBHOOK_NO_FILEURL', ['payload' => $req->all()]);
            return response()->json(['ok' => false, 'error' => 'no_file_url'], 400);
        }

        $format   = strtolower((string)$req->input('format', ''));
        $urlLower = strtolower($fileUrl);

        $ext = 'pdf';
        if (str_contains($urlLower, '.png') || $format === 'png') {
            $ext = 'png';
        } elseif (str_contains($urlLower, '.jpg') || str_contains($urlLower, '.jpeg')) {
            $ext = 'jpg';
        }

        $dir      = trim(config('apishot.dir', 'apishot/results'), '/');
        $filename = $suggest ?: ($jobId . '.' . $ext);
        $filename = ltrim($filename, '/');
        $path     = $dir . '/' . $filename;

        if (Storage::disk('public')->exists($path) && Storage::disk('public')->size($path) > 2048) {
            $publicUrl = asset('storage/' . $path);
            Log::info('APISHOT.WEBHOOK_ALREADY_SAVED', ['job_id' => $jobId, 'path' => $path]);
            return response()->json(['ok' => true, 'path' => $path, 'url' => $publicUrl, 'cached' => true]);
        }

        $accept = $ext === 'png' ? 'image/png' : ($ext === 'jpg' ? 'image/jpeg' : 'application/pdf');
        $resp   = Http::timeout(60)->withHeaders(['Accept' => $accept])->get($fileUrl);

        if (!$resp->ok()) {
            Log::warning('APISHOT.WEBHOOK_DOWNLOAD_NON200', [
                'job' => $jobId, 'status' => $resp->status(), 'url' => $fileUrl
            ]);
            return response()->json(['ok' => false, 'error' => 'download_non200'], 502);
        }

        $bytes = $resp->body();

        if ($ext === 'pdf' && !(str_starts_with($bytes, '%PDF-'))) {
            Log::warning('APISHOT.WEBHOOK_PDF_MAGIC_MISSING', [
                'job' => $jobId, 'url' => $fileUrl, 'head_hex' => bin2hex(substr($bytes, 0, 5))
            ]);
            return response()->json(['ok' => false, 'error' => 'not_pdf'], 502);
        }

        Storage::disk('public')->makeDirectory($dir);
        Storage::disk('public')->put($path, $bytes);

        $publicUrl = asset('storage/' . $path);
        $byteCount = Storage::disk('public')->size($path);

        Log::info('APISHOT.WEBHOOK_SAVED', [
            'job_id'    => $jobId,
            'path'      => Storage::disk('public')->path($path),
            'bytes'     => $byteCount,
            'publicUrl' => $publicUrl,
        ]);

        if ($userId && $kind) {
            // Normalize kind
            $kind = strtolower(str_replace(['-', ' '], '_', $kind));

            if ($kind === 'payment_receipt') {
                // Attach receipt to the most recent payment row for this user,
                // so list pages using latestPayment see it immediately.
                $pay = Payment::where('user_id', $userId)->orderByDesc('id')->first();
                if (!$pay) {
                    $pay = new Payment();
                    $pay->user_id = $userId;
                    // Keep minimal defaults; other fields can be null
                    $pay->status = 'generated';
                    $pay->currency = $pay->currency ?: 'INR';
                }
                $pay->payment_rec = $path;
                $pay->save();
                Log::info('APISHOT.WEBHOOK_PAYMENT_SAVED', ['user_id' => $userId, 'path' => $path, 'payment_id' => $pay->id]);
            } else {
                // Map kinds to columns
                $map = [
                    'idcard'          => 'idcard',
                    'joining_letter'  => 'appointment_letter',
                    'honor_letter'    => 'honar_letter', // DB column uses 'honar'
                    'official_1'      => 'official_1',
                    'official_2'      => 'official_2',
                    'affidavit'       => 'before_affidavit',
                ];

                $column = $map[$kind] ?? null;

                if ($column) {
                    // Use Query Builder to avoid model-level blockers
                    $affected = DB::table('users')
                        ->where('id', $userId)
                        ->update([$column => $path, 'updated_at' => now()]);

                    if ($affected > 0) {
                        Log::info('APISHOT.WEBHOOK_USER_UPDATE_OK', [
                            'user_id' => $userId, 'column' => $column, 'path' => $path
                        ]);
                    } else {
                        Log::warning('APISHOT.WEBHOOK_USER_UPDATE_ZERO', [
                            'user_id' => $userId, 'column' => $column, 'path' => $path
                        ]);
                    }
                } else {
                    Log::warning('APISHOT.WEBHOOK_KIND_UNMAPPED', ['kind' => $kind]);
                }
            }
        } else {
            Log::warning('APISHOT.WEBHOOK_NO_USER_OR_KIND', compact('userId','kind'));
        }

        return response()->json(['ok' => true, 'path' => $path, 'url' => $publicUrl]);
    }
}
