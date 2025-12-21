UI-Template / Theme-Engine + PageBuilder (dapunabi/ui-template)

Purpose: Multi-tenant PageBuilder + Theme Engine with DB-stored templates/blocks, shortcode support, Vue/Vuetify editor, import/export, caching, and API.

Install (dev, via path repo)
- Add to root composer.json repositories: {"type":"path","url":"packages/dapunabi/ui-template","options":{"symlink":true}}
- composer require dapunabi/ui-template:* --prefer-source
- php artisan ui-template:install

Phase 1 — Package Setup & Foundations
- Service provider: mergeConfigFrom, loadRoutesFrom, loadMigrationsFrom, loadViewsFrom, publishes.
- Migrations: ui_pages, ui_templates, ui_blocks, ui_revisions.
- Basic routes: /admin/ui/pages, /admin/ui/templates, /ui/editor; APIs /api/v1/pages/{slug}, /api/v1/theme/config.
- Command: ui-template:install (publish config/views, migrate, optional seed).

Phase 2 — Models & Admin Lists
- Models: Page, Template, Block, Revision with factories.
- Admin index CRUD stubs (list/create/edit) for pages & templates.
- Tenant scoping via tenant_id() helper; fallback to CoreAuth TenantManager.
- Seeder: demo blocks (hero, features, footer), a sample page and template.

Phase 3 — Visual Editor MVP
- Vue 3 + Vuetify editor shell mounted on /ui/editor.
- Block palette (left), canvas (center), props (right), save to ui_revisions.
- Page render pipeline: compose blocks → HTML; simple SSR in Blade.

Phase 4 — Shortcodes & Content API
- Shortcode engine: [cta id=123], [gallery id=5], pluggable resolvers.
- API GET /api/v1/pages/{slug}: returns resolved HTML & metadata.
- Caching layer with per-tenant invalidation.

Phase 5 — Theme Engine & Tokens
- Theme tokens per tenant; ThemeCompiler → Vuetify tokens.
- GET /api/v1/theme/config; admin UI to edit tokens and preview.

Phase 6 — Import/Export & Versioning
- Export templates/pages/blocks to JSON; import with conflict resolution.
- Revision compare, rollback; publish snapshot as static export.

Phase 7 — Permissions & Multi-tenant Controls
- Enforce roles/permissions (CoreAuth) for editor/admin routes.
- Per-tenant overrides and defaults; feature flags.

Phase 8 — SEO, i18n, Accessibility, Sitemap
- Per-page SEO fields, localized slugs, basic a11y checks, sitemap.xml.

Phase 9 — Advanced Blocks Library
- Product card, blog list (with CoreAuth posts), contact form, gallery with uploads.

Phase 10 — Packaging & Update Flow
- README docs, ui-template:run-post-update command, publish assets, clear caches.

Packaging & Commands
- Version: 0.1.0
- Post-update helper: `php artisan ui-template:run-post-update`
  - Publishes config/views, runs package migrations (optional flags: --no-migrate, --no-publish), clears caches.
- Export static page: `php artisan ui-template:export {page_slug} --path=public/exports`
- Export template ZIP: `php artisan ui-template:export-template {slug} --tenant=ID --path=storage/app/exports`
- Import template ZIP: `php artisan ui-template:import-template storage/app/exports/{slug}-template.zip --tenant=ID`
- Generate sitemap: `php artisan ui-template:generate-sitemap --tenant=ID --path=public`

QA Checklist (Manual)
- Editor
  - /ui/editor?slug=home → add hero/features/footer; Save Draft → Publish
  - Re-open editor; blocks persist; responsive toggles work
- Render
  - /p/home loads and shows published content
  - /api/v1/pages/home returns { ok: true, html, published }
- Theme
  - /admin/ui/theme → change tokens → live preview updates
  - /api/v1/theme/config returns vuetify + css_variables
- Blocks
  - /admin/ui/blocks → add a JSON manifest → appears in list
- Import/Export
  - Export template ZIP → re-import into tenant → appears in templates
- i18n
  - /ui/editor?slug=home&locale=ur → create localized variant; /p/home?locale=ur renders variant
- Accessibility
  - /api/v1/pages/home/a11y lists warnings; fix content and verify fewer warnings
- Sitemap
  - ui-template:generate-sitemap writes public/sitemap.xml

Seeders & Sample Tenant
- `UiTemplateSeeder` seeds starter blocks and a `starter-landing` template.
- Works with Tenancy-Adapter + CoreAuth; if `tenants` or `coreauth_tenants` has a `default` tenant, seeds link to it.

Unit Tests (selection)
- ShortcodeParser (CTA + unknown passthrough)
- Renderer (hero block)
- TemplateRenderer cache (idempotent output)
  - Run: `php artisan test --testsuite=Feature` or `composer test`

Smoke Tests (UI)
- /admin/ui/pages and /admin/ui/templates render.
- /ui/editor loads shell.
- /api/v1/pages/{slug} returns placeholder JSON, then rendered HTML after Phase 3–4.

