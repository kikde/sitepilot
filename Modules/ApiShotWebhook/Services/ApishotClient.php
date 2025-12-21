<?php

namespace Modules\ApiShotWebhook\Services;

use Illuminate\Support\Facades\Http;

class ApishotClient
{
    public function renderImage(string $url, string $format='png', array $opts=[]): array
    {
        $base = rtrim(config('apishot.base', env('APISHOT_BASE','')), '/');
        $key  = config('apishot.key',  env('APISHOT_KEY',''));
        $hdr  = config('apishot.header', 'x-api-key');

        if (!$base || !$key) {
            throw new \RuntimeException('Apishot not configured');
        }

        $payload = array_merge(['url'=>$url,'format'=>$format,'async'=>true], $opts);

        $res = Http::timeout(20)
            ->withHeaders([$hdr=>$key,'content-type'=>'application/json'])
            ->post($base.'/render/image', $payload);

        if (!$res->ok()) {
            throw new \RuntimeException('Apishot error: '.$res->status().' '.$res->body());
        }
        return $res->json(); // { id, status }
    }

    public function renderPdf(string $url, array $opts=[]): array
    {
        $base = rtrim(config('apishot.base', env('APISHOT_BASE','')), '/');
        $key  = config('apishot.key',  env('APISHOT_KEY',''));
        $hdr  = config('apishot.header', 'x-api-key');

        if (!$base || !$key) {
            throw new \RuntimeException('Apishot not configured');
        }

        $payload = array_merge(['url'=>$url,'async'=>true], $opts);

        $res = Http::timeout(20)
            ->withHeaders([$hdr=>$key,'content-type'=>'application/json'])
            ->post($base.'/render/pdf', $payload);

        if (!$res->ok()) {
            throw new \RuntimeException('Apishot error: '.$res->status().' '.$res->body());
        }
        return $res->json(); // { id, status }
    }
}
