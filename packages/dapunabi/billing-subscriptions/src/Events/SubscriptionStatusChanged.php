<?php

namespace Dapunabi\Billing\Events;

class SubscriptionStatusChanged
{
    public int $tenantId;
    public string $planCode;
    public ?string $oldStatus;
    public string $newStatus;
    public string $reason;

    public function __construct(int $tenantId, string $planCode, ?string $oldStatus, string $newStatus, string $reason = 'system')
    {
        $this->tenantId = $tenantId;
        $this->planCode = $planCode;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->reason = $reason;
    }
}

