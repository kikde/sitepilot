@php($status = session('status'))
<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tenant Domains</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <nav>
      <ul>
        <li><strong>Domains for {{ $tenant->name }}</strong></li>
      </ul>
      <ul>
        <li><a href="{{ route('tenancy.admin.tenants.index') }}">Back</a></li>
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

    <h3>Add Domain</h3>
    <form method="post" action="{{ route('tenancy.admin.tenants.domains.add', ['id' => $tenant->id]) }}">
      @csrf
      <label>
        Domain
        <input type="text" name="domain" placeholder="example.com" required>
      </label>
      <button type="submit">Add</button>
    </form>

    <h3>Existing Domains</h3>
    <table>
      <thead>
        <tr>
          <th>Domain</th>
          <th>Status</th>
          <th>Verified At</th>
          <th>Verification Token</th>
          <th>Instructions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($domains as $d)
          <tr>
            <td>{{ $d->domain }}</td>
            <td>{{ strtoupper($d->status) }}</td>
            <td>{{ $d->verified_at }}</td>
            <td><code>{{ $d->verification_token }}</code></td>
            <td>
              Create a TXT record on your DNS:
              <pre>_tenancy.{{ $d->domain }}  TXT  {{ $d->verification_token }}</pre>
              or host a file at:
              <pre>https://{{ $d->domain }}/.well-known/tenancy-verify.txt</pre>
              containing the token above.
              Then run:
              <pre>php artisan tenancy:verify-domains --domain={{ $d->domain }} --simulate</pre>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No domains yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </body>
  </html>

