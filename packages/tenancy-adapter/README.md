Tenancy-Adapter (dapunjabi/tenancy-adapter)

Phase 1 provides:
- Service provider with config/views/migrations publish
- Migrations: tenants, tenant_domains
- Console: `php artisan tenancy:install`
- Seeder: creates Default Tenant and Tenant B
- Minimal admin UI: `/admin/tenants`, `/admin/tenants/create`

Local development install (path repo):
1) In host composer.json add repositories entry:
   {"type":"path","url":"packages/tenancy-adapter","options":{"symlink":true}}
2) `composer require dapunjabi/tenancy-adapter:* --prefer-source`
3) `php artisan tenancy:install`
4) Visit `/admin/tenants` and `/admin/tenants/create`

DB-per-Tenant Compatibility (Phase 9)
- Interface: `Dapunjabi\TenancyAdapter\Database\TenancyConnectionResolver` determines the connection name per tenant.
- Default: `DefaultTenancyConnectionResolver` returns the app `database.default` connection.
- Command (dry-run): `php artisan tenancy:migrate-tenant {tenant} --dry-run`
  - {tenant} may be ID or slug
  - Prints connection preview and the future migrate command that would run
  - No actual migrations are executed yet
- To implement real per-tenant DBs later:
  - Create a resolver that maps tenant -> connection name (and connection config via runtime) 
  - Ensure connections are present in `config/database.php` or injected at runtime
  - Run: `php artisan migrate --database={resolved} --path=packages/tenancy-adapter/src/Migrations`

Packaging, Versioning & Update Flow (Phase 10)
- Composer setup
  - PSR-4: Dapunjabi\\TenancyAdapter\\ => src/
  - Auto-discovery: extra.laravel.providers includes Dapunjabi\\TenancyAdapter\\TenancyServiceProvider
- Host project update steps
  1) composer update dapunjabi/tenancy-adapter
  2) php artisan tenancy:run-post-update --publish --force
  3) php artisan migrate --path=packages/tenancy-adapter/src/Migrations
  4) (Optional) Clear caches again if needed: php artisan optimize:clear
- Post-update helper command
  - php artisan tenancy:run-post-update publishes tenancy assets (when --publish) and clears caches.
  - Use --force to overwrite existing published files.
