<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiShot
{
    /**
     * Kick an async render job with rich options.
     *
     * @param  int    $userId
     * @param  string $viewPath   e.g. "idcard/86", "payment-receipt/74"
     * @param  array  $opts
     * @return array              ['job_id' => string] OR ['error' => '...']
     */
    public static function capture(int $userId, string $viewPath, array $opts = []): array
    {
        Log::info('APISHOT.CAPTURE_ENTER', compact('userId', 'viewPath', 'opts'));

        // ── Resolve config (support both legacy and new keys)
        $viewBase = rtrim(
            config('member.viewbase') ?: config('apishot.view_base') ?: env('VIEW_BASE', ''),
            '/'
        );
        $apiBase = rtrim(
            config('member.apishot.base') ?: config('apishot.base') ?: env('APISHOT_BASE', ''),
            '/'
        );
        $apiKey = config('member.apishot.key') ?: config('apishot.key') ?: env('APISHOT_KEY');
        $secret = config('member.apishot.secret') ?: config('apishot.secret') ?: env('APISHOT_SECRET');

        // Webhook endpoints (default to your existing routes)
        $webhookUrl    = $opts['webhookUrl']    ?? url('/api/apishot/webhook');
        $datasinkUrl   = $opts['datasinkUrl']   ?? url('/api/apishot/datasink');
        $webhookSecret = $opts['webhookSecret'] ?? $secret;

        if (!$viewBase || !$apiBase) {
            Log::warning('APISHOT.CONFIG_MISSING', [
                'viewBase'    => $viewBase,
                'apiBase'     => $apiBase,
                'key_present' => (bool)$apiKey,
                'secret_set'  => (bool)$secret,
            ]);
            return ['error' => 'config'];
        }

        // ── Build target URL and infer kind if meta not provided
        if (preg_match('#^https?://#i', $viewPath)) {
            $targetUrl = $viewPath;
        } else {
            $targetUrl = $viewBase . '/' . ltrim($viewPath, '/');
        }


$kind = 'generic';
$vp   = $viewPath;
if (str_contains($vp, 'payment-receipt'))                                   $kind = 'payment_receipt';
elseif (str_contains($vp, 'idcard'))                                        $kind = 'idcard';
elseif (str_contains($vp, 'joining-letter'))                                $kind = 'joining_letter';
elseif (str_contains($vp, 'off1-letter'))                                   $kind = 'official_1';
elseif (str_contains($vp, 'off2-letter'))                                   $kind = 'official_2';
elseif (str_contains($vp, 'honor-letter'))                                  $kind = 'honor_letter';
elseif (str_contains($vp, 'documents/affidavit') || str_contains($vp, 'affi-letter')) $kind = 'affidavit';

// ✅ Merge per-kind defaults into $opts BEFORE reading $opts below.
// Use "+" so caller-provided values in $opts override these defaults.
if ($kind === 'affidavit') {
    $opts = [
        // Keep engine paper size to A4; no external scaling.
        'pageSize'          => 'A4',
        'printBackground'   => true,
        'margin'            => ['top'=>0,'right'=>0,'bottom'=>0,'left'=>0],
        'preferCSSPageSize' => true,   // let CSS @page also be respected if present

        // 🔑 Render at A4 pixel size (96dpi): ~794 x 1123. No 'scale' key.
        'viewport'          => ['width'=>794, 'height'=>1123, 'deviceScaleFactor'=>1],
        // *** Do NOT set 'scale' here ***
    ] + $opts;
}

        // ── Ext & endpoint
        $ext      = strtolower($opts['ext'] ?? 'pdf');
        $endpoint = $ext === 'png' ? '/render/image' : '/render/pdf';

        // ── Filename suggestion (allow override via filename or suggest)
        $suggest = $opts['suggest']
            ?? (($opts['filename'] ?? 'document') . '_' . time() . '.' . ($ext === 'png' ? 'png' : 'pdf'));

        // ── Defaults that matched your working payloads
        $waitUntil       = $opts['waitUntil']       ?? 'networkidle';
        $waitFor         = $opts['waitFor']         ?? 1200;
        $pageSize        = $opts['pageSize']        ?? 'A4';
        $printBackground = array_key_exists('printBackground', $opts) ? (bool)$opts['printBackground'] : true;

        // ──────────────────────────────────────────────────────────────────────────
        // ONE PLACE TO CONTROL PER-TEMPLATE SIZES/VIEWPORTS/SCALING
        // Key is the first path segment (slug) of $viewPath, e.g. "idcard" in "idcard/86"
        // Edit these values as needed; they are used unless explicitly overridden in $opts.
        // For PNG output you can also provide 'png' => [ 'fullPage' => ..., 'clip' => [...] ].
        // ──────────────────────────────────────────────────────────────────────────
       $slug = strtok($vp, '/');
if ($slug === 'documents' && str_contains($vp, '/affidavit/')) {
    $slug = 'affidavit';
}

        $TEMPLATES = [
            'affidavit' => [
                'pdf' => [
                    'preferCSSPageSize' => true,
                    'pageSize'          => 'A4',
                    'landscape'         => false,
                    'printBackground'   => true,
                    'scale'             => 1.00,
                ],
                'viewport' => ['width' => 2366, 'height' => 1920, 'deviceScaleFactor' => 2],
            ],

            'idcard' => [
                'pdf' => [
                    'preferCSSPageSize' => true,
                    'pageSize'          => 'A4',
                    'landscape'         => false,
                    'printBackground'   => true,
                    'scale'             => 1.00,
                ],
                'viewport' => ['width' => 1440, 'height' => 1024, 'deviceScaleFactor' => 2],
            ],

            // Right-edge cut in your screenshot → gentle shrink here
            'honor-letter' => [
                'pdf' => [
                    'preferCSSPageSize' => true,
                    'pageSize'          => 'A4',
                    'landscape'         => false,
                    'printBackground'   => true,
                    'scale'             => 0.92, // <— adjust if needed
                ],
                'viewport' => ['width' => 1366, 'height' => 1920, 'deviceScaleFactor' => 2],
            ],

            'joining-letter' => [
                'pdf' => [
                    'preferCSSPageSize' => true,
                    'pageSize'          => 'A4',
                    'landscape'         => false,
                    'printBackground'   => true,
                    'scale'             => 1.00,
                ],
                'viewport' => ['width' => 1366, 'height' => 1920, 'deviceScaleFactor' => 2],
            ],

            'off1-letter' => [
                'pdf' => [
                    'preferCSSPageSize' => true,
                    'pageSize'          => 'A4',
                    'landscape'         => false,
                    'printBackground'   => true,
                    'scale'             => 1.00,
                ],
                'viewport' => ['width' => 1366, 'height' => 1920, 'deviceScaleFactor' => 2],
            ],

            'off2-letter' => [
                'pdf' => [
                    'preferCSSPageSize' => true,
                    'pageSize'          => 'A4',
                    'landscape'         => false,
                    'printBackground'   => true,
                    'scale'             => 1.00,
                ],
                'viewport' => ['width' => 1366, 'height' => 1920, 'deviceScaleFactor' => 2],
            ],

            'payment-receipt' => [
                'pdf' => [
                    'preferCSSPageSize' => true,
                    'pageSize'          => 'A4',
                    'landscape'         => false,
                    'printBackground'   => true,
                    'scale'             => 1.00,
                ],
                'viewport' => ['width' => 1280, 'height' => 900, 'deviceScaleFactor' => 2],
                // Example for PNG crops if you ever switch to image output:
                // 'png' => [
                //     'fullPage' => false,
                //     'clip' => ['x'=>120, 'y'=>180, 'width'=>960, 'height'=>640],
                // ],
            ],
        ];

        // Build base payload
        $payload = [
            'url'           => $targetUrl,
            'async'         => true,
            'waitUntil'     => $waitUntil,
            'waitFor'       => $waitFor,
            'webhookUrl'    => $webhookUrl,
            'webhookSecret' => $webhookSecret,

            // Both blocks provided (your webhook reads either)
            'meta' => array_merge([
                'user_id' => $userId,
                'kind'    => $kind,
                'suggest' => $suggest,
            ], $opts['meta'] ?? []),

            'datasinkUrl'  => $datasinkUrl,
            'datasinkMeta' => array_merge([
                'user_id' => $userId,
                'kind'    => $kind,
                'suggest' => $suggest,
            ], $opts['datasinkMeta'] ?? []),
        ];

        // Timeouts
        if (isset($opts['timeout']) && is_numeric($opts['timeout'])) {
            $payload['timeout'] = (int)$opts['timeout'];
        }

        // Headers/cookies for the page render (NOT for Apishot auth)
        if (!empty($opts['headers']) || !empty($opts['authToken'])) {
            $payload['headers'] = $opts['headers'] ?? [];
            if (!empty($opts['authToken'])) {
                $payload['headers']['Authorization'] = $opts['authToken'];
            }
        }
        if (!empty($opts['cookies'])) {
            $payload['cookies'] = $opts['cookies'];
        }

        // Viewport (may be overwritten by template defaults below)
        if (!empty($opts['viewport'])) {
            $payload['viewport'] = $opts['viewport'];
        }

        // PDF vs PNG specifics (user opts first)
        if ($ext === 'pdf') {
            if (!empty($opts['paperSize'])) {
                $payload['paperSize'] = $opts['paperSize']; // ['width'=>mm,'height'=>mm,'unit'=>'mm']
            } else {
                $payload['pageSize'] = $pageSize;
            }
            $payload['printBackground'] = $printBackground;

            if (array_key_exists('landscape', $opts))         $payload['landscape']         = (bool)$opts['landscape'];
            if (array_key_exists('scale', $opts))             $payload['scale']             = (float)$opts['scale'];
            if (!empty($opts['margin']))                      $payload['margin']            = $opts['margin'];
            if (array_key_exists('preferCSSPageSize', $opts)) $payload['preferCSSPageSize'] = (bool)$opts['preferCSSPageSize'];
            if (!empty($opts['headerTemplate']))              $payload['headerTemplate']    = $opts['headerTemplate'];
            if (!empty($opts['footerTemplate']))              $payload['footerTemplate']    = $opts['footerTemplate'];
        } else { // png
            $payload['format'] = 'png';
            if (empty($opts['viewport'])) {
                $payload['width']             = $opts['width']  ?? 1366;
                $payload['height']            = $opts['height'] ?? 900;
                $payload['deviceScaleFactor'] = $opts['deviceScaleFactor'] ?? 2;
            }
            if (array_key_exists('fullPage', $opts)) $payload['fullPage'] = (bool)$opts['fullPage'];
            if (!empty($opts['clip']))               $payload['clip']     = $opts['clip'];
        }

        // ── Apply template overrides (do not override explicit $opts)
        if (isset($TEMPLATES[$slug])) {
            $ov = $TEMPLATES[$slug];

            // viewport override
            if (!empty($ov['viewport']) && empty($opts['viewport'])) {
                $payload['viewport'] = $ov['viewport'];
            }

            if ($ext === 'pdf' && !empty($ov['pdf'])) {
                foreach ($ov['pdf'] as $k => $v) {
                    if (!array_key_exists($k, $opts)) {
                        $payload[$k] = $v;
                    }
                }
            }

            if ($ext === 'png' && !empty($ov['png'])) {
                foreach ($ov['png'] as $k => $v) {
                    if (!array_key_exists($k, $opts)) {
                        $payload[$k] = $v;
                    }
                }
            }
        }

        // Remove nulls
        $payload = self::arrayFilterNulls($payload);

        Log::info('APISHOT.KICK_POST', ['endpoint' => $apiBase.$endpoint, 'payload' => $payload]);

        try {
            $http = Http::withHeaders([
                        'x-api-key'    => $apiKey,
                        'Content-Type' => 'application/json',
                        'Accept'       => 'application/json',
                    ])->timeout(30);

            // Retry up to 5 times if the provider returns 429
            $max = 5; $res = null;
            for ($i = 0; $i < $max; $i++) {
                $res = $http->post($apiBase.$endpoint, $payload);

                // success or non-429 → stop retrying
                if ($res->status() !== 429) break;

                $delay = (int)(pow(2, $i) * 250); // 250ms, 500ms, 1s, 2s, 4s
                Log::warning('APISHOT.RATE_LIMIT', ['try' => $i+1, 'delay_ms' => $delay]);
                usleep($delay * 1000);
            }

            Log::info('APISHOT.KICK_RESP', ['status' => $res->status(), 'body' => $res->json()]);

            if (!$res->ok()) {
                Log::warning('APISHOT.KICK_NON200', ['status' => $res->status(), 'body' => $res->body()]);
                return ['error' => 'http'];
            }

            $jobId = $res->json('id');
            if (!$jobId) {
                Log::warning('APISHOT.KICK_NO_ID', ['body' => $res->body()]);
                return ['error' => 'no_id'];
            }

            Log::info('APISHOT.KICK_OK', ['job_id' => $jobId, 'kind' => $kind, 'url' => $targetUrl]);
            return ['job_id' => $jobId];

        } catch (\Throwable $e) {
            Log::error('APISHOT.UNEXPECTED', ['msg' => $e->getMessage()]);
            return ['error' => 'exception'];
        }
    }

    /** Recursively remove null values (preserve 0/false/"") */
    private static function arrayFilterNulls(array $arr): array
    {
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $arr[$k] = self::arrayFilterNulls($v);
            } elseif ($v === null) {
                unset($arr[$k]);
            }
        }
        return $arr;
    }
}
