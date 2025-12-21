# Verification Checklist (Tenancy / Billing / Media / NGO)

Run:

`php artisan project:health`

It checks required tables/routes and prints the main URLs to test.

## Tenancy

**Admin UI**
- `http://127.0.0.1:8000/admin/tenants`

**Tenant debug**
- `http://127.0.0.1:8000/tenant/debug`
- `http://127.0.0.1:8000/api/v1/tenant/config`

**Domain tenant test (recommended)**
1. Add to Windows hosts file: `127.0.0.1 tenantb.local`
2. Open: `http://tenantb.local:8000/tenant/debug`
3. Confirm tenant id/domain differs from `127.0.0.1`

## Billing / Subscriptions

**Admin**
- `http://127.0.0.1:8000/admin/plans`
- `http://127.0.0.1:8000/admin/billing/invoices`

**Tenant portal**
- `http://127.0.0.1:8000/billing`

## Media Manager

**Admin UI**
- `http://127.0.0.1:8000/admin/media`

**Public share**
- `http://127.0.0.1:8000/media/share/{token}`

## NGO plugin mount

Default mount is `/ngo`:
- `http://127.0.0.1:8000/ngo`

If you disable legacy routes (`NGO_LEGACY_ROUTES=false`), only `/ngo/*` routes should work.

