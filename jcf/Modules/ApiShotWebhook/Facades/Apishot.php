<?php

namespace Modules\ApiShotWebhook\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array captureReceipt(int|string $receiptId, string $format='png', int $validMinutes=5, array $opts=[])
 * @method static array captureUrl(string $url, string $format='png', array $opts=[])
 * @method static array getResult(string $jobId)
 */
class Apishot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modules\ApiShotWebhook\Services\SnapshotService::class;
    }
}
