@php($status = session('status'))
<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Theme</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <nav>
      <ul>
        <li><strong>Tenant Theme</strong></li>
      </ul>
      <ul>
        <li><a href="{{ route('tenancy.admin.tenants.index') }}">Back</a></li>
      </ul>
    </nav>

    <h2>Theme for {{ $tenant->name }}</h2>
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

    <form method="post" action="{{ route('tenancy.admin.tenants.theme.update', ['id' => $tenant->id]) }}" enctype="multipart/form-data">
      @csrf
      <label>
        Primary Color
        <input type="text" name="primary" value="{{ $theme['primary'] ?? '#3b82f6' }}" placeholder="#3b82f6">
      </label>
      <label>
        Logo
        <input type="file" name="logo" accept="image/*">
      </label>
      @if(($theme['logo_url'] ?? null))
        <img src="{{ $theme['logo_url'] }}" alt="Logo" style="max-height:64px">
      @endif
      <fieldset>
        <label>
          <input type="checkbox" name="feature_mfa" value="1" @checked(($features['mfa'] ?? false))>
          Enable MFA
        </label>
        <label>
          <input type="checkbox" name="feature_billing" value="1" @checked(($features['billing'] ?? false))>
          Enable Billing
        </label>
        <label>
          <input type="checkbox" name="feature_pos" value="1" @checked(($features['enable_pos'] ?? ($features['pos'] ?? false)))>
          Enable POS
        </label>
        <label>
          <input type="checkbox" name="feature_ecommerce" value="1" @checked(($features['enable_ecommerce'] ?? ($features['ecommerce'] ?? false)))>
          Enable Ecommerce
        </label>
      </fieldset>
      <label>
        Storage Quota (MB)
        <input type="number" min="0" step="1" name="storage_quota_mb" value="{{ data_get($tenant->settings,'quotas.storage_quota_mb', 0) }}" placeholder="0 = unlimited">
      </label>
      <button type="submit">Save</button>
    </form>
  </body>
  </html>
