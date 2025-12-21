# CoreAuth (Phase 1)

Composer-ready Laravel package scaffold for CoreAuth.

## Install (local path testing)

1. Ensure your app `composer.json` has a path repository to `packages/CoreAuth`.
2. Run: `composer require dapunjabi/coreauth:0.1.0` (or `*`).
3. Run: `php artisan coreauth:install`.

## What it does (Phase 1)

- Registers service provider via auto-discovery.
- Loads routes, views, migrations.
- Publishes config, views, assets, migrations.
- Adds `coreauth:install` command to publish, migrate, and seed a superadmin user.

## Phase 2: User Management & Authentication

Routes (UI):
- `/register` — Register user
- `/login` — Login form
- `/password/reset` — Request password reset link
- `/password/reset/{token}` — Reset form
- `/account/profile` — Edit profile (name, email, password)
- `/dashboard` — Post-login landing

Seeders:
- `php artisan coreauth:seed` seeds:
  - Superadmin (from config)
  - Test User 1 (verified): test1@example.com / password123
  - Test User 2 (unverified): test2@example.com / password123

Notes on verification:
- For email verification flows to send notifications, set your `User` model to implement `Illuminate\Contracts\Auth\MustVerifyEmail` and use the corresponding trait.

Testing steps:
1) Register new user at `/register` and confirm creation in DB.
2) Login at `/login`, confirm redirect to `/dashboard`.
3) Use `/password/reset` to request link and submit the reset at `/password/reset/{token}`; login with new password.
4) Update name/email/password at `/account/profile`, confirm DB updates.

## Phase 3: Multi‑Tenant & Roles/Permissions

Features:
- Tenant resolver (domain/subdomain/header/session)
- Tenant creation (seeded + manual via DB/UI later)
- Roles: superadmin, admin, editor, viewer
- Permissions matrix, enforced via middleware

UI links:
- `/tenant/select` — Choose active tenant
- `/admin/roles` — Assign roles per tenant
- `/admin/permissions` — Map permissions to roles

Test data (via `php artisan coreauth:seed`):
- Tenants: `default`, `second`
- Users: Superadmin (from config), Test1 (admin), Test2 (viewer), Test4 (multi‑tenant)
- Roles/Permissions mapped (superadmin bypasses checks)

Testing:
1) Select tenant at `/tenant/select`.
2) Visit `/admin/roles` to assign roles; verify access controls.
3) As Superadmin, manage roles/permissions; as normal user, verify limited access.

## Phase 4: MFA & Session Management

Features:
- MFA setup with TOTP (Google Authenticator compatible)
- MFA verification during login (challenge step)
- Recovery codes support
- Session tracking (IP, device, last activity) and revocation

Routes:
- `/mfa/setup` — Generate secret, QR, and enable MFA
- `/mfa/verify` — Challenge page after password login
- `/account/sessions` — List sessions and revoke

Test data:
- Test User 3 with MFA: test3@example.com / password123; secret pre-seeded

Testing steps:
1) Enable MFA for your user at `/mfa/setup` (scan QR and confirm).
2) Logout, login — you should be redirected to `/mfa/verify` to enter the code.
3) Visit `/account/sessions` to see active sessions; revoke one and confirm termination.
4) Verify IP/device info recorded per session.

## Phase 5: License / Billing Integration

Features:
- License states on tenant: `active`, `past_due`, `suspended` (stored on `coreauth_tenants.license_status`)
- Middleware `license` blocks access to tenant pages when not `active`
- Billing page lists invoices and allows paying a due invoice

UI:
- Dashboard shows a license badge and a Billing link
- `/billing` — shows invoices and allows paying due invoices

Test data (via `coreauth:seed`):
- Tenant `default` → active license + paid invoice
- Tenant `second` → past_due license + due invoice `INV-2001`

Testing:
1) Select `default` tenant at `/tenant/select`; open `/dashboard` → badge shows ACTIVE.
2) Select `second` tenant; try `/dashboard` or admin pages → redirected to `/billing` with notice.
3) On `/billing`, click Pay for the due invoice → license switches to ACTIVE, restricted pages are accessible again.
