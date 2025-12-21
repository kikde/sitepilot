<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Service Unavailable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <article>
      <header>
        <h2>We'll be right back</h2>
      </header>
      <p>
        The tenant <strong>{{ $tenant->name }}</strong> is currently {{ $tenant->status ?? 'unavailable' }}.
        Please try again later.
      </p>
      <footer>
        <small>Request host: {{ request()->getHost() }}</small>
      </footer>
    </article>
  </body>
  </html>

