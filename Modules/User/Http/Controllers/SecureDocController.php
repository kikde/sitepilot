<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Modules\User\Entities\User;

class SecureDocController extends Controller
{
    /** Stream file inline for <img src> or in-browser PDF view */
    public function view(Request $request, User $user, string $type)
    {
        if (! (auth()->id() === $user->id || (auth()->user()?->role == 1))) {
            abort(403);
        }

        $path = $this->mapPath($user, $type);
        if (!$path) abort(404);

        // New standard: private disk first (inline)
        if (Storage::disk('private')->exists($path)) {
            return Storage::disk('private')->response($path);
        }

        // Public disk (fallback)
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->response($path);
        }

        // Legacy public_path fallback (very old storage)
        $legacy = public_path($path);
        if (is_file($legacy)) {
            return response()->file($legacy);
        }

        abort(404);
    }

    /** Force a file download */
    public function download(Request $request, User $user, string $type)
    {
        if (! (auth()->id() === $user->id || (auth()->user()?->role == 1))) {
            abort(403);
        }

        $path = $this->mapPath($user, $type);
        if (!$path) abort(404);

        if (Storage::disk('private')->exists($path)) {
            return Storage::disk('private')->download($path);
        }
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }
        $legacy = public_path($path);
        if (is_file($legacy)) {
            return response()->download($legacy);
        }

        abort(404);
    }

    /** Map {type} to the path stored on the user/payment models */
    protected function mapPath(User $user, string $type): ?string
    {
        $map = [
            'profile'     => $user->profile_image,
            'idproof'     => $user->idproof_doc,
            'other'       => $user->other_doc,
            'aff_before'  => $user->before_affidavit ?? null,
            'aff_after'   => $user->after_verifiy_affidavit ?? null,
        ];

        $path = $map[$type] ?? null;

        // Fallback: if original affidavit missing, try last successful APIshot job
        if ($type === 'aff_before' && empty($path)) {
            try {
                $job = DB::table('apishot_jobs')
                    ->where('user_id', (int)$user->id)
                    ->where('kind', 'affidavit')
                    ->where('status', 'done')
                    ->whereNotNull('stored_path')
                    ->latest('updated_at')
                    ->first();
                if ($job && !empty($job->stored_path)) {
                    $path = $job->stored_path; // relative public disk path
                }
            } catch (\Throwable $e) {
                // ignore and return null below
            }
        }

        return $path;
    }
}
