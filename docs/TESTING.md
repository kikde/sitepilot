# Testing Guide (What to check before go-live)

This project has **two different admin experiences**:
- **Platform / SuperAdmin** (you/your team): manage tenants, domains, billing, roles.
- **Tenant / Customer Admin** (your NGO customer): manage their own website content via the **legacy NGO admin panel** (`/home` with the long left menu). Tenancy concepts stay hidden from them.

## 1) Platform (SuperAdmin) checks

1. Login: `https://baseproject.test/login`
2. Platform dashboard: `https://baseproject.test/platform`
3. Tenants: `https://baseproject.test/admin/tenants`
   - Create a tenant
   - Add a domain
   - Verify the domain
4. Billing admin:
   - Plans: `https://baseproject.test/admin/plans`
   - Invoices: `https://baseproject.test/admin/billing/invoices`

Validation:
- Platform URLs require SuperAdmin login.
- Tenant users cannot access platform routes.

### Platform: create a tenant + domain (Laragon)
1. Go to `https://baseproject.test/admin/tenants` → create tenant.
2. Open tenant → Domains → add `tenant1.test` and click verify.
3. Confirm in DB (optional):
   - `tenant_domains.status = verified`
   - `tenant_domains.verified_at` is not null

## 2) Tenant (Customer) login + admin panel checks

1. Open tenant domain login (example):
   - `https://tenant1.test/login`
2. After login it must land on:
   - `https://tenant1.test/home`
3. Admin panel content routes must work:
   - News: `https://tenant1.test/newsList`
   - Pages: `https://tenant1.test/pageList`
   - Home banners: `https://tenant1.test/home/banner-list`
   - Home what-to-do: `https://tenant1.test/home/what-to-do-list`
   - Home award static: `https://tenant1.test/home/static-section`
   - Home award items: `https://tenant1.test/home/award-section`
   - Donors: `https://tenant1.test/donors`
   - Donations: `https://tenant1.test/donations`
   - Support tickets: `https://tenant1.test/support-tickets`
   - Settings: `https://tenant1.test/settings`
   - Photo gallery: `https://tenant1.test/photogallery`
   - Partners: `https://tenant1.test/partner`
   - Members: `https://tenant1.test/members`
   - Member categories: `https://tenant1.test/category`

Validation:
- Login page has no left sidebar.
- `/home` shows the full left sidebar menu.
- Any content/admin route redirects to login if not authenticated.
- Legacy users are auto-mapped to tenant roles on first request.

### If the left sidebar menu is missing (role/permission quick-fix)
For an imported DB user (example `sara@kikde.com`):

1. Make the user an admin in the legacy column:
   - `php artisan tinker --execute="DB::table('users')->where('email','sara@kikde.com')->update(['role'=>1,'useractive'=>1]); echo 'ok';"`
2. Ensure CoreAuth tenant-role exists for that tenant (replace IDs):
   - `php artisan tinker --execute="DB::table('coreauth_role_user')->updateOrInsert(['user_id'=>1,'tenant_id'=>3,'role_slug'=>'tenant_admin'],[]); echo 'ok';"`
3. Clear caches:
   - `php artisan optimize:clear`
4. Re-login on `https://tenant1.test/login` and open `https://tenant1.test/home`.

## 3) Tenant data isolation checks (MOST IMPORTANT)

Goal: Tenant1 and Tenant2 must NOT see each other’s admin data.

1. Login to `tenant1.test`
   - Create a News post in `tenant1.test/newsList`
2. Login to `tenant2.test`
   - Confirm the tenant1 post does NOT appear in `tenant2.test/newsList`

Repeat for:
- Pages (`/pageList`)
- Donors (`/donors`)
- Donations (`/donations`)
- Support tickets (`/support-tickets`)

Validation:
- Cross-tenant record IDs should not be accessible.

## 4) Billing/license gate checks

1. As SuperAdmin, open `https://baseproject.test/admin/plans` and create:
   - plan name + price
   - `seat_limit` (example `3`)
2. Assign plan to tenant / create invoice (UI: `admin/tenants` or `admin/billing/invoices` depending on workflow).
3. As tenant admin, open `https://tenant1.test/billing`:
   - confirm invoice list / checkout works
   - confirm seats page works: `https://tenant1.test/billing/seats`
4. Mark a tenant as `past_due` or `suspended` (platform tooling / DB) and try tenant admin routes:
   - `/newsList`, `/donors`, `/admin/media`, `/members`

Validation:
- `past_due`: still works but shows warning.
- `suspended`: redirects to `/billing` and blocks admin/content routes.

## 5) SEO / Front website checks

1. Tenant front site:
   - `https://tenant1.test/ngo`
2. Check key pages:
   - `/ngo/about`
   - `/ngo/contact`

Validation:
- No 500 errors.
- Assets load (CSS/JS).
