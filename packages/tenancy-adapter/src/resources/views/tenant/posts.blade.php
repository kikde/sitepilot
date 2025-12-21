<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tenant Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <nav>
      <ul>
        <li><strong>Tenant Posts</strong></li>
      </ul>
      <ul>
        <li><a href="/tenant/debug">Debug</a></li>
      </ul>
    </nav>
    <h2>Posts for {{ $tenant?->name ?? 'Unknown Tenant' }}</h2>
    <ul>
      @forelse($posts as $post)
        <li>
          <article>
            <header><strong>{{ $post->title }}</strong></header>
            @if($post->body)
              <p>{{ $post->body }}</p>
            @endif
            <footer class="muted">#{{ $post->id }} • {{ $post->created_at }}</footer>
          </article>
        </li>
      @empty
        <li>No posts for this tenant.</li>
      @endforelse
    </ul>
  </body>
  </html>

