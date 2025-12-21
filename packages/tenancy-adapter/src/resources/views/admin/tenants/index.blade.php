@php($status = session('status'))
<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tenants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <nav>
      <ul>
        <li><strong>Tenancy Admin</strong></li>
      </ul>
      <ul>
        <li><a href="{{ route('tenancy.admin.tenants.create') }}">Create Tenant</a></li>
      </ul>
    </nav>

    @if($status)
      <article class="contrast">{{ $status }}</article>
    @endif

    <h2>Tenants</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Domains</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tenants as $tenant)
          <tr>
            <td>{{ $tenant->id }}</td>
            <td>{{ $tenant->name }}</td>
            <td>{{ $tenant->slug }}</td>
            <td>{{ $tenant->domains()->count() }}</td>
            <td>
              <small>{{ strtoupper($tenant->status ?? 'active') }}</small>
            </td>
            <td>
              <a href="{{ route('tenancy.admin.tenants.show', ['id' => $tenant->id]) }}">View</a>
              |
              <a href="{{ route('tenancy.admin.tenants.theme', ['id' => $tenant->id]) }}">Theme</a>
              |
              <a href="{{ route('tenancy.admin.tenants.domains', ['id' => $tenant->id]) }}">Domains</a>
              |
              <form method="post" action="{{ route('tenancy.admin.tenants.status', ['id' => $tenant->id]) }}" style="display:inline">
                @csrf
                <select name="status" onchange="this.form.submit()">
                  @foreach(['active','suspended','pending'] as $s)
                    <option value="{{ $s }}" @selected(($tenant->status ?? 'active') === $s)>{{ ucfirst($s) }}</option>
                  @endforeach
                </select>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No tenants yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </body>
</html>
