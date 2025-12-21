<?php

namespace Dapunabi\Billing\Gateways;

use Dapunabi\Billing\Models\Plan;
use Stripe\StripeClient;

class StripeAdapter
{
    protected StripeClient $stripe;

    public function __construct(?string $secret = null)
    {
        $secret = $secret ?: config('billing.stripe.secret');
        if (!$secret) {
            throw new \RuntimeException('Stripe secret not configured.');
        }
        $this->stripe = new StripeClient($secret);
    }

    public function createCheckoutSession(int $tenantId, int $userId, Plan $plan, string $successUrl, string $cancelUrl): string
    {
        $priceInCents = (int) round($plan->price * 100);

        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => $successUrl.'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $cancelUrl,
            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower($plan->currency),
                    'product_data' => [ 'name' => $plan->name ],
                    'unit_amount' => $priceInCents,
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'tenant_id' => (string) $tenantId,
                'user_id' => (string) $userId,
                'plan_code' => $plan->code,
                'interval' => $plan->interval,
            ],
        ]);

        return $session->url;
    }
}

