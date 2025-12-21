<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quota Exceeded</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <article>
      <header>
        <h2>Storage quota exceeded</h2>
      </header>
      <p>
        Tenant <strong>{{ $tenant?->name ?? 'unknown' }}</strong> has used
        <strong>{{ $used_mb }} MB</strong> of <strong>{{ $quota_mb }} MB</strong>.
      </p>
      <p>Please remove files or increase quota, then try again.</p>
    </article>
  </body>
  </html>

