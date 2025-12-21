# Pluginization roadmap (BaseProject)

This repo uses `BaseProject` as the host app. The old `jcf` project is reference-only.

## Current stable baseline (Phase 0)

**NGO frontend plugin:** `packages/jcf/ngo-site`

### UI structure (in progress)
- Keep legacy entry views (e.g. `frontend.pages.index`) as wrappers for route/view stability.
- Put real page markup in feature folders under `packages/jcf/ngo-site/src/resources/views/frontend/pages/*`.
  - Example: `frontend/pages/index.blade.php` → `@include('frontend.pages.home._content')`

### Frontend validation
- `/ngo` (homepage)
- `/about`
- `/news-post`
- `/success-story`
- `/our-members`
- `/our-donors`
- `/photo-gallery`
- `/video-gallery`
- `/user-donate`

### Backend validation
- Login `/login`
- CoreAuth admin: `/admin/roles`, `/admin/permissions`
- Tenancy admin: `/admin/tenants`
- Modules (examples): `/pages`, `/newsList`, `/donors`, `/donations`, `/users`

## Phase 1 — CoreAuth

Goal: stable auth + roles/permissions for admin/backend pages.

Validation:
- `GET /login`, `POST /login`, `GET /register`, `GET /password/reset`
- Access control: non-admin blocked from admin/module routes
- CoreAuth admin UI loads: `/admin/roles`, `/admin/permissions`

## Phase 2 — Tenancy Adapter

Goal: tenant selection + tenant-aware data boundaries (start with a default tenant).

Validation:
- Default tenant resolves (no redirects/403 on public pages)
- `/admin/tenants` works; tenant status changes apply
- (Optional) tenant selection flow works if enabled

## Phase 3 — Billing/Subscription

Goal: plan gating, invoices, and webhooks.

Validation:
- Admin plans page loads
- Webhook endpoints reachable
- Tenant feature gates behave as expected

## Phase 4 — Convert `Modules/*` → packages

Goal: move legacy modules into reusable composer packages (plugin-by-plugin).

Validation (per module move):
- Routes still resolve
- Admin CRUD still works
- Frontend pages still work
