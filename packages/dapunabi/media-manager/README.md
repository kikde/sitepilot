# dapunabi/media-manager

Multi-tenant media manager for Laravel: uploads, S3 presign, variants, PDF thumbs, dedupe, sharing, quotas, bulk zips, events, and admin UI.

## Install (local development)

1) Add path repository in host composer.json and require:

```
composer require dapunabi/media-manager:* --prefer-source
```

2) Install package:

```
php artisan media:install
```

This publishes config, runs package migrations, and creates the `storage` symlink.

## Config

Edit `config/media-manager.php` (publish via `vendor:publish --tag=media-config`). Key options:

- `disk`: `public` (local) or `s3`
- `cdn_url`: optional CDN base URL
- `allowed_mimes`, `blocked_extensions`: security allow/block lists
- `virus_scan`: enable `clamav` scanning (if available)
- `quota_per_tenant_mb`: per-tenant cap
- `signing`: `kid`, `secret`, `rotate_before` (for presign token rotation)

## S3 + CloudFront

Set env:

```
MEDIA_DISK=s3
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket
AWS_URL= # optional
MEDIA_CDN_URL= # optional CloudFront domain for public URLs
```

Presign flow uses S3 presigned PUT for upload, and `temporaryUrl` for signed GETs. Application-level tokens (HMAC) guard the `complete` API and can be rotated immediately via `MEDIA_SIGN_ROTATE_BEFORE`.

CloudFront signed URLs are not included by default; if needed, implement a signer and swap `downloadUrl()` to use CDN signing.

## Commands

- `php artisan media:install` — publish config/migrations and run migrations
- `php artisan media:recalculate-usage [--tenant=]` — rebuild `media_storage_stats`
- `php artisan media:prune [--dry-run] [--tenant=]` — list/remove unreferenced media (uses `media_usage`)
- `php artisan media:run-post-update` — publish assets and clear caches after composer update

## Admin UI

- `/admin/media` — library with filters, bulk ops (zip/delete/tag/move)
- `/admin/media/upload` — server-side upload form
- `/admin/media/{id}` — detail, versions, visibility, share links, tags/folder
- `/admin/media/duplicates` — duplicate hashes overview

## API

- `POST /api/v1/media/upload` — server upload
- `POST /api/v1/media/presign` — presign PUT (S3); returns `url`, `key`, and `token`
- `POST /api/v1/media/complete` — record object into DB; requires `token`
- `GET /api/v1/media/{id}/download` — signed download redirect

## Events & Integration

- `MediaUploaded(Media $media)`
- `VariantsGenerated(int $mediaId, array $variants)`
- `MediaDeleted(int $mediaId)`

Public API service: `Dapunabi\Media\Services\MediaApi`:

- `url($id)`, `variantUrl($id, $name)`
- `recordUsage($mediaId, $usedIn, $referenceId, $tenantId?)`
- `removeUsage($mediaId, $usedIn, $referenceId?)`
- `usages($mediaId)`

## Testing notes

- Variant generation uses Intervention/Image. Install it for full functionality:

```
composer require intervention/image
```

- PDF thumbs require Imagick extension.
- Queue worker required for jobs (`php artisan queue:work`).

## QA Checklist

- Upload (image, PDF) → variants/thumbs created
- Presign to S3 → complete → DB record exists → variants queued
- Visibility: private/shared/public; share tokens work & expire
- Dedupe: same file reuses path/record (per config)
- Quotas: exceeding limit blocks upload
- Bulk zip creates a ZIP file entry
- Filters/search/tags/folders behave correctly
- Security: disallowed extensions/MIME rejected; old presign tokens rejected after rotation

