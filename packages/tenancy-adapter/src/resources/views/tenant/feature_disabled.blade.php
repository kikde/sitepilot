<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Feature Unavailable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <article>
      <header>
        <h2>Feature turned off</h2>
      </header>
      <p>
        The feature <strong>{{ $feature }}</strong> is disabled for tenant
        <strong>{{ $tenant?->name ?? 'unknown' }}</strong>.
      </p>
    </article>
  </body>
  </html>

