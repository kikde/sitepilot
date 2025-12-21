<?php

namespace Dapunabi\Media\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PresignService
{
    protected function sign(array $payload, ?string $kid = null): string
    {
        $kid = $kid ?: (string) (config('media-manager.signing.kid') ?? 'v1');
        $secret = (string) (config('media-manager.signing.secret') ?? '');
        $payload['kid'] = $kid;
        $json = json_encode($payload, JSON_UNESCAPED_SLASHES);
        $sig = base64_encode(hash_hmac('sha256', $json, $secret, true));
        return base64_encode($json).'..'.$sig;
    }

    protected function verify(string $token): ?array
    {
        $parts = explode('..', $token);
        if (count($parts) !== 2) return null;
        [$b64, $sig] = $parts;
        $json = base64_decode($b64, true);
        if ($json === false) return null;
        $payload = json_decode($json, true);
        if (!is_array($payload)) return null;
        $secret = (string) (config('media-manager.signing.secret') ?? '');
        $calc = base64_encode(hash_hmac('sha256', $json, $secret, true));
        if (!hash_equals($calc, $sig)) return null;
        // rotation: invalidate tokens issued before rotate_before
        $rb = (string) (config('media-manager.signing.rotate_before') ?? '');
        if ($rb) {
            try { $rbTs = strtotime($rb); if (!empty($payload['iat']) && $payload['iat'] < $rbTs) return null; } catch (\Throwable $e) {}
        }
        if (!empty($payload['exp']) && $payload['exp'] < time()) return null;
        return $payload;
    }
    public function makeObjectKey(?int $tenantId, string $originalName): string
    {
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION) ?: 'bin');
        $uuid = (string) Str::uuid();
        $datePath = date('Y/m/d');
        $tenantPart = $tenantId ? 'tenants/'.$tenantId.'/media' : 'media';
        return $tenantPart.'/'.$datePath.'/'.$uuid.'.'.$ext;
    }

    /**
     * Create a presigned PUT URL for S3 (or compatible drivers).
     */
    public function presignPut(string $disk, string $key, int $ttl = 900): array
    {
        // Only S3 supports presigned PUT via underlying client
        if ($disk !== 's3') {
            return [ 'driver' => $disk, 'unsupported' => true ];
        }
        $adapter = Storage::disk($disk)->getAdapter();
        if (!method_exists($adapter, 'getClient')) {
            // Flysystem v3 adapter has getClient()
            return [ 'driver' => $disk, 'unsupported' => true ];
        }
        $client = $adapter->getClient();
        $bucket = $adapter->getBucket();
        $cmd = $client->getCommand('PutObject', [
            'Bucket' => $bucket,
            'Key' => $key,
        ]);
        $request = $client->createPresignedRequest($cmd, "+{$ttl} seconds");
        $token = $this->sign([
            'key' => $key,
            'iat' => time(),
            'exp' => time() + $ttl,
        ]);
        return [
            'url' => (string) $request->getUri(),
            'method' => 'PUT',
            'headers' => [
                // AWS signs via URL; no special headers required besides content-type if desired
            ],
            'key' => $key,
            'bucket' => $bucket,
            'token' => $token,
        ];
    }

    /**
     * Build a temporary download URL (signed) if supported, else a public URL.
     */
    public function downloadUrl(string $disk, string $path, int $ttl = 900): string
    {
        // Prefer S3 temporaryUrl when enabled
        if ($disk === 's3' && config('media-manager.use_temporary_url', true)) {
            try {
                return Storage::disk($disk)->temporaryUrl($path, now()->addSeconds($ttl));
            } catch (\Throwable $e) {
                // fallback
            }
        }
        $cdn = rtrim((string) config('media-manager.cdn_url', ''), '/');
        if ($cdn !== '') {
            return $cdn.'/'.ltrim($path, '/');
        }
        return Storage::disk($disk)->url($path);
    }

    public function verifyToken(string $token): bool
    {
        return $this->verify($token) !== null;
    }
    public function payload(string $token): ?array { return $this->verify($token); }
}
