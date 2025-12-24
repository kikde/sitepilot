<?php

namespace App\Services;

use Razorpay\Api\Api;

class RazorpayRecurringService
{
    protected Api $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }

    /**
     * Create UPI Autopay subscription
     *
     * @param  string $planId
     * @param  int    $totalCount   e.g. 12 for 12 cycles
     * @param  array  $customer     ['name','email','mobile']
     * @param  array  $notes        any extra info
     * @return array                subscription array
     */
    public function createUpiSubscription(string $planId, int $totalCount, array $customer = [], array $notes = []): array
    {
        $data = [
            'plan_id'         => $planId,
            'total_count'     => $totalCount,
            'quantity'        => 1,
            'customer_notify' => 1,
            // UPI autopay is mostly configured at plan+account level;
            // payment_method field is optional in Razorpay but we’ll add it for clarity:
            'payment_method'  => 'upi',
        ];

        if (!empty($notes)) {
            $data['notes'] = $notes;
        }

        if (!empty($customer)) {
            $data['customer'] = [
                'name'    => $customer['name']   ?? null,
                'email'   => $customer['email']  ?? null,
                'contact' => $customer['mobile'] ?? null,
            ];
        }

        $subscription = $this->api->subscription->create($data);

        return $subscription->toArray();
    }

    /**
     * Verify subscription signature sent by Razorpay
     */
    public function verifySubscriptionSignature(
        string $subscriptionId,
        string $paymentId,
        string $signature
    ): bool {
        $generated = hash_hmac(
            'sha256',
            $subscriptionId . '|' . $paymentId,
            config('services.razorpay.secret')
        );

        return hash_equals($generated, $signature);
    }
}
