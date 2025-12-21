# Dapunabi Billing-Subscriptions

Multi-tenant billing and subscriptions for Laravel. Designed to work alongside CoreAuth and Tenancy-Adapter.

Features (by phase)
- Plans, subscriptions, invoices, seats
- Local gateway (dev), Stripe Checkout + webhooks
- PDF invoices and downloads
- Grace period + auto-suspend scheduler
- Admin tools: manual invoices, refund simulation, webhook logs + replay

## Installation (Local Path Repository)

1) Add to your host app `composer.json` repositories section:

```json
{
  "type": "path",
  "url": "packages/dapunabi/billing-subscriptions",
  "options": { "symlink": true }
}
```

2) Require the package:

```
composer require dapunabi/billing-subscriptions:* --prefer-source
```

3) Install and seed (optional):

```
php artisan billing:install
```

This publishes `config/billing.php`, runs package migrations, and seeds sample plans.

## Environment & Config

Required for Stripe (Phase 3):

```
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

Grace period / auto-suspend (Phase 6):

```
BILLING_GRACE_DAYS=7
BILLING_SUSPEND_AFTER_GRACE=true
```

See `config/billing.php` for defaults.

## Webhooks

- Endpoint: `POST /webhooks/stripe`
- Signature verification uses `STRIPE_WEBHOOK_SECRET`
- Logged to `billing_webhook_logs` and processed idempotently
- Admin UI: `/admin/webhooks` with replay

### Local Development (Stripe CLI / ngrok)

Option A — Stripe CLI (recommended):

```
stripe listen --forward-to http://127.0.0.1:8000/webhooks/stripe
```

Set the displayed webhook secret into `.env` as `STRIPE_WEBHOOK_SECRET`.

Option B — ngrok:

```
ngrok http http://127.0.0.1:8000
```

Use the public URL to configure a Stripe webhook in the dashboard.

## UI Endpoints

- Customer:
  - `/billing` — select plan, pay (Local/Stripe), link to invoices
  - `/billing/invoices` — list invoices
  - `/billing/invoices/{id}/download` — PDF
  - `/billing/seats` — seat management

- Admin:
  - `/admin/plans` — plans CRUD (basic)
  - `/admin/billing/invoices` — manual invoices + refund (void)
  - `/admin/webhooks` — webhook logs + replay

## Console Commands

- `billing:install` — publish config, migrate, seed
- `billing:check-past-due` — auto-suspend beyond grace window (Phase 6)
- `billing:run-post-update` — publish config (force), migrate package path, clear caches

Run the scheduler to enable daily checks:

```
php artisan schedule:work
```

## Update Flow

After pulling new package code:

```
composer update dapunabi/billing-subscriptions
php artisan billing:run-post-update
```

This will refresh config, migrations, and caches.

