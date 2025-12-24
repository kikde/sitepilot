<?php

namespace Modules\ApiShotWebhook\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\User\Entities\User;
use Modules\User\Entities\Payment;

class WebhookController extends Controller
{
    /**
     * APIshot calls this when a job finishes.
     * Accepts JSON like:
     * {
     *   "id": "uuid",
     *   "status": "succeeded|failed",
     *   "file": "https://.../file.pdf"           // optional
     *   "url": "https://.../file.pdf",           // optional
     *   "result_url": "https://.../file.pdf",    // optional
     *   "local_path": "/abs/path/to/file.pdf",   // optional (what you're getting)
     *   "error": "..."                           // on failure
     * }
     */
    public function handle(Request $request)
    {
        $payload = $request->all();
        $jobId   = $payload['id']     ?? $payload['job_id'] ?? null;
        $status  = $payload['status'] ?? null;

        if (!$jobId) {
            Log::warning('APIshot webhook: missing job id', ['body' => $payload]);
            return response()->json(['ok' => true]);
        }

        // Load job meta we created when queuing
        $job = DB::table('apishot_jobs')->where('job_id', $jobId)->first();
        if (!$job) {
            Log::warning('APIshot webhook: unknown job id', ['job' => $jobId]);
            return response()->json(['ok' => true]);
        }

        if ($status !== 'succeeded') {
            $err = $payload['error'] ?? 'failed';
            DB::table('apishot_jobs')->where('job_id', $jobId)->update([
                'status'     => 'failed',
                'last_error' => $err,
                'updated_at' => now(),
            ]);
            return response()->json(['ok' => true]);
        }

        // Prefer any public URLs first (if present)
        $remoteUrl = $payload['file']
            ?? $payload['url']
            ?? $payload['result_url']
            ?? null;

        // We will save everything to storage/app/public/apishot/results/{jobId}.pdf/png
        $ext = Str::endsWith(strtolower($job->suggested_filename), '.png') ? 'png' : 'pdf';
        $relPath  = 'apishot/results/'.$jobId.'.'.$ext; // relative path inside public disk
        $absSaved = null;

        try {
            if ($remoteUrl) {
                // Download and store
                $bin = @file_get_contents($remoteUrl);
                if ($bin === false) {
                    Log::warning('APIshot: download failed', ['job_id' => $jobId, 'url' => $remoteUrl]);
                    throw new \RuntimeException('download failed');
                }
                Storage::disk('public')->put($relPath, $bin);
                $absSaved = Storage::disk('public')->path($relPath);
            } elseif (!empty($payload['local_path']) && is_file($payload['local_path'])) {
                // Copy from local_path into our public disk
                $stream = fopen($payload['local_path'], 'rb');
                Storage::disk('public')->put($relPath, $stream);
                if (is_resource($stream)) fclose($stream);
                $absSaved = Storage::disk('public')->path($relPath);
            } else {
                Log::warning('APISHOT.NO_FILE_URL', ['body' => $payload]);
                // Mark failed for visibility
                DB::table('apishot_jobs')->where('job_id', $jobId)->update([
                    'status'     => 'failed',
                    'last_error' => 'no file/url/local_path in payload',
                    'updated_at' => now(),
                ]);
                return response()->json(['ok' => true]);
            }

            $publicUrl = Storage::url($relPath); // e.g. /storage/apishot/results/uuid.pdf

            // Update apishot_jobs table
            DB::table('apishot_jobs')->where('job_id', $jobId)->update([
                'status'      => 'done',
                'stored_path' => $relPath,   // keep relative path for asset(Storage::url(...))
                'last_error'  => null,
                'updated_at'  => now(),
            ]);

            Log::info('APIshot: result saved', [
                'job_id'   => $jobId,
                'path'     => $absSaved,
                'publicUrl'=> url($publicUrl),
            ]);

            // Attach to the right column based on "kind"
            // kinds: payment_receipt, idcard, joining_letter, official_1, official_2, honor_letter, affidavit
            $kind   = $job->kind ?? 'generic';
            $userId = (int) $job->user_id;

            if ($kind === 'payment_receipt') {
                $pay = Payment::firstOrCreate(['user_id' => $userId], []);
                // Store the *relative* path so Blade can use Storage::url()
                $pay->payment_rec = $relPath;
                $pay->save();
            } else {
                $user = User::find($userId);
                if ($user) {
                    switch ($kind) {
                        case 'idcard':          $user->idcard             = $relPath; break;
                        case 'joining_letter':  $user->appointment_letter  = $relPath; break;
                        case 'official_1':      $user->official_1          = $relPath; break;
                        case 'official_2':      $user->official_2          = $relPath; break;
                        case 'honor_letter':    $user->honar_letter        = $relPath; break;
                        case 'affidavit':       $user->before_affidavit    = $relPath; break;
                        default: /* noop */     break;
                    }
                    $user->save();
                }
            }

            return response()->json(['ok' => true]);
        } catch (\Throwable $e) {
            Log::error('APIshot webhook save error', [
                'job_id' => $jobId,
                'err'    => $e->getMessage()
            ]);
            DB::table('apishot_jobs')->where('job_id', $jobId)->update([
                'status'     => 'failed',
                'last_error' => $e->getMessage(),
                'updated_at' => now(),
            ]);
            return response()->json(['ok' => true]);
        }
    }
}
