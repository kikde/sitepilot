@php($status = session('status'))
<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tenant Media</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <nav>
      <ul>
        <li><strong>Media for {{ $tenant?->name ?? 'Unknown' }}</strong></li>
      </ul>
      <ul>
        <li><a href="/tenant/debug">Debug</a></li>
      </ul>
    </nav>
    @if($status)
      <article class="contrast">{{ $status }}</article>
    @endif
    @if($errors->any())
      <article class="contrast">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </article>
    @endif
    <p>Used: <strong>{{ number_format($usedMb,2) }} MB</strong> /
      Quota: <strong>{{ $quotaMb > 0 ? $quotaMb.' MB' : 'Unlimited' }}</strong></p>
    <form method="post" action="{{ route('tenancy.media.store') }}" enctype="multipart/form-data">
      @csrf
      <label>
        File
        <input type="file" name="file" required>
      </label>
      <button type="submit">Upload</button>
    </form>
  </body>
  </html>

