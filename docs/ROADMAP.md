# Roadmap (Plugin-first Platform + Tenants)

This repo is a **multi-tenant platform**:
- **Platform / SuperAdmin**: creates tenants, attaches domains, configures billing, manages roles.
- **Tenant / Customer Admin**: logs in on their own domain and manages content via the legacy NGO admin (`/home`).

## What is already in place

### Platform vs Tenant separation
- Platform dashboard: `/platform` (SuperAdmin only).
- Tenant login: `/login` is branded and has no sidebar.
- Tenant landing: tenant users go to `/home` (legacy NGO admin panel with long sidebar).

### Plugin baseline
- CoreAuth: authentication, permissions, tenant selection/resolution.
- Tenancy Adapter: domain → tenant resolution.
- Billing: plans/invoices + license gate + seat limits.
- Media Manager: admin media UI + multi-tenant compatibility.
- NGO site: mounted at `/ngo`.

### Tenant isolation (core content)
- Added `tenant_id` columns and scoping for:
  - `posts`, `pages`, `donors`, `donations`, `donation_subscriptions`
  - `support_tickets`, `support_ticket_messages`, `support_ticket_departments`
- Converted global uniqueness to per-tenant uniqueness where needed:
  - `posts(sector_name)` → `(tenant_id, sector_name)`
  - `pages(name)` → `(tenant_id, name)`
- Added baseline “template clone” logic for new tenants (copy rows where `tenant_id` is null into the tenant).

## Remaining work (recommended order)

### Phase 1 — Stabilize tenant admin UX (customer-facing)
- Make sure all customer admin routes are protected (`auth + tenant + license + seat + permissions`).
- Standardize redirects:
  - tenant login → `/home`
  - platform login → `/platform`
- Ensure the legacy NGO sidebar/menu renders based on CoreAuth permissions (not only `users.role`).

Validation:
- As tenant user: `/home`, `/newsList`, `/pageList`, `/donors`, `/donations` all work and require login.
- As SuperAdmin (no tenant): `/platform`, `/admin/tenants`, `/admin/plans` work and are not accessible to tenants.

### Phase 2 — Finish tenant isolation for remaining modules
- Confirm every “content” table is tenant-scoped (example: `settings`, `members`, `categories`, `galleries`, `partners`, banners, etc).
- Ensure model global scopes + migrations cover remaining unique constraints.
- Remove any remaining “cross-tenant” queries (raw DB queries without tenant filters).

Validation:
- Create content in `tenant1.test` and confirm it never appears in `tenant2.test`.

### Phase 3 — Billing enforcement + demo flows
- Define the “customer lifecycle”:
  - trial → active → past_due → suspended
- UX:
  - show warning banner when `past_due`
  - block admin/content routes when `suspended` and redirect to `/billing`
- Seats:
  - enforce `seat_limit` on user invites / user creation
  - show seat usage clearly in billing UI

Validation:
- Past due shows warning but allows work; suspended blocks admin routes.

### Phase 4 — Theming (multi-website reuse)
- Add “Theme Manager” per tenant:
  - default theme
  - custom themes (NGO / School / News / Travel)
- Provide UI preset import/export (use `ui-template` plugin where possible).
- Goal: swap a tenant’s frontend and admin theme without code changes.

Validation:
- Change theme for tenant1 and verify tenant2 is unchanged.

### Phase 5 — Cleanup + packaging
- Move remaining legacy views/assets into the correct plugin packages.
- Remove duplicate views and unify naming conventions (category-wise folders).
- Add a “Create Tenant Wizard” in platform:
  - create tenant + domain + first admin user + theme preset + optional seed data

Validation:
- New tenant can be created end-to-end in minutes with no manual DB steps.
