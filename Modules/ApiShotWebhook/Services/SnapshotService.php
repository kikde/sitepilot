<?php

namespace Modules\ApiShotWebhook\Services;

use Illuminate\Support\Facades\DB;
use Modules\ApiShotWebhook\Support\SignedLink;

class SnapshotService
{
    public function __construct(protected ApishotClient $client) {}

    /** Start a render for a receipt id (signed URL → Apishot render). */
    public function captureReceipt(int|string $receiptId, string $format='png', int $validMinutes=5, array $opts=[]): array
    {
        $signed = SignedLink::receipt($receiptId, $validMinutes);
        if ($format === 'pdf') {
            $job = $this->client->renderPdf($signed, $opts);
        } else {
            $job = $this->client->renderImage($signed, $format, $opts);
        }
        return ['ok'=>true, 'job'=>$job, 'signed_url'=>$signed];
    }

    /** Start a render for any arbitrary URL. */
    public function captureUrl(string $url, string $format='png', array $opts=[]): array
    {
        if ($format === 'pdf') {
            $job = $this->client->renderPdf($url, $opts);
        } else {
            $job = $this->client->renderImage($url, $format, $opts);
        }
        return ['ok'=>true, 'job'=>$job, 'signed_url'=>$url];
    }

    /** Lookup the latest apishot_events row for a given job id (what webhook saved). */
    public function getResult(string $jobId): array
    {
        $row = DB::table('apishot_events')
            ->select('job_id','status','result_url','bytes','payload')
            ->where('job_id',$jobId)
            ->orderByDesc('id')
            ->first();

        if (!$row) return ['found'=>false];

        $payload = is_string($row->payload) ? json_decode($row->payload, true) : ($row->payload ?: []);
        return [
            'found'            => true,
            'status'           => $row->status,
            'result_url'       => $row->result_url,
            'saved_public_url' => $payload['saved_public_url'] ?? null,
            'bytes'            => (int) ($row->bytes ?? 0),
            'payload'          => $payload,
        ];
    }
}
