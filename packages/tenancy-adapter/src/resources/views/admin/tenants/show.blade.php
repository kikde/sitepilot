<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tenant Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <nav>
      <ul>
        <li><strong>Tenant: {{ $tenant->name }}</strong></li>
      </ul>
      <ul>
        <li><a href="{{ route('tenancy.admin.tenants.index') }}">Back</a></li>
      </ul>
    </nav>

    <article>
      <header>
        <h3>Overview</h3>
      </header>
      <ul>
        <li>ID: {{ $tenant->id }}</li>
        <li>Slug: {{ $tenant->slug }}</li>
        <li>Status: <strong>{{ strtoupper($tenant->status ?? 'active') }}</strong></li>
        <li>Users: <strong>{{ $usersCount }}</strong></li>
      </ul>
    </article>

    <article>
      <header>
        <h3>Theme Preview</h3>
      </header>
      <div style="display:flex; align-items:center; gap:16px;">
        <div style="width:32px; height:32px; border-radius:6px; background: {{ $theme['primary'] ?? '#3b82f6' }};"></div>
        <div>Primary: {{ $theme['primary'] ?? '#3b82f6' }}</div>
        @if(($theme['logo_url'] ?? null))
          <img src="{{ $theme['logo_url'] }}" alt="Logo" style="max-height:48px">
        @endif
      </div>
      <p style="margin-top:8px;">
        <a href="{{ route('tenancy.admin.tenants.theme', ['id' => $tenant->id]) }}">Edit Theme</a>
      </p>
    </article>

    <article>
      <header>
        <h3>Domains</h3>
      </header>
      <table>
        <thead>
          <tr><th>Domain</th><th>Status</th><th>Verified At</th></tr>
        </thead>
        <tbody>
          @forelse($tenant->domains as $d)
            <tr>
              <td>{{ $d->domain }}</td>
              <td>{{ strtoupper($d->status) }}</td>
              <td>{{ $d->verified_at }}</td>
            </tr>
          @empty
            <tr><td colspan="3">No domains</td></tr>
          @endforelse
        </tbody>
      </table>
      <p style="margin-top:8px;">
        <a href="{{ route('tenancy.admin.tenants.domains', ['id' => $tenant->id]) }}">Manage Domains</a>
      </p>
    </article>
  </body>
  </html>

