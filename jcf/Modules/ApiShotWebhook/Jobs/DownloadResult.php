<?php

namespace Modules\ApiShotWebhook\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Modules\ApiShotWebhook\Entities\ApishotEvent;

class DownloadResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $url;
    public ?string $jobId;
    public array $meta;

    public function __construct(string $url, ?string $jobId = null, array $meta = [])
    {
        $this->url   = $url;
        $this->jobId = $jobId;
        $this->meta  = $meta;
    }

    public function handle(): void
    {
        try {
            $res = Http::timeout(30)->get($this->url);
            if (!$res->ok()) {
                throw new \RuntimeException('HTTP '.$res->status());
            }
            $bytes = $res->body();

            $extFromUrl = pathinfo(parse_url($this->url, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION);
            $ext = $extFromUrl ?: 'bin';

            $dir  = trim(config('apishot.store_path', 'apishot/results'), '/');
            $name = ($this->jobId ?: uniqid('apishot_', true)).'.'.$ext;

            // save on PUBLIC disk so it's reachable at /storage/...
            Storage::disk('public')->makeDirectory($dir);
            Storage::disk('public')->put($dir.'/'.$name, $bytes);

            $publicUrl = URL::to('storage/'.$dir.'/'.$name);
            $savedPath = storage_path('app/public/'.$dir.'/'.$name);
            $byteCount = strlen($bytes);

            // enrich event.payload with saved URLs/paths (no schema change)
            try {
                $event = ApishotEvent::where('job_id', $this->jobId)->latest('id')->first();
                if ($event) {
                    $payload = is_array($event->payload) ? $event->payload : (json_decode((string)$event->payload, true) ?: []);
                    $payload['saved_public_url'] = $publicUrl;
                    $payload['saved_path']       = $savedPath;

                    $event->bytes   = $byteCount;
                    $event->payload = $payload;
                    $event->save();
                }
            } catch (\Throwable $e) {
                Log::warning('APIshot: could not update event payload', [
                    'job_id' => $this->jobId,
                    'error'  => $e->getMessage(),
                ]);
            }

            Log::info('APIshot: result downloaded', [
                'job_id'    => $this->jobId,
                'path'      => $savedPath,
                'publicUrl' => $publicUrl,
                'bytes'     => $byteCount,
            ]);
        } catch (\Throwable $e) {
            Log::error('APIshot: download failed', [
                'job_id' => $this->jobId,
                'url'    => $this->url,
                'error'  => $e->getMessage(),
            ]);
            $this->release(30);
        }
    }
}
