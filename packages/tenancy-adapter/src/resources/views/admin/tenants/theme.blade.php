@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Theme & Features</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('tenancy.admin.tenants.index') }}">Tenants</a></li>
              <li class="breadcrumb-item"><a href="{{ route('tenancy.admin.tenants.show', ['id' => $tenant->id]) }}">{{ $tenant->name }}</a></li>
              <li class="breadcrumb-item active">Theme</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <div class="row">
    <div class="col-lg-7 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Branding</h4></div>
        <div class="card-body">
          <form method="post" action="{{ route('tenancy.admin.tenants.theme.update', ['id' => $tenant->id]) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Theme Preset</label>
              <select name="theme_preset" class="form-control">
                @foreach(($themePresets ?? ['default']) as $preset)
                  <option value="{{ $preset }}" @selected(($theme['preset'] ?? 'default') === $preset)>{{ $preset }}</option>
                @endforeach
              </select>
              <small class="text-muted">Preset controls default colors and components. You can still override primary color.</small>
            </div>

            <div class="form-group">
              <label>Primary Color</label>
              <input type="text" class="form-control" name="primary" value="{{ $theme['primary'] ?? '#3b82f6' }}" placeholder="#3b82f6">
            </div>

            <div class="form-group">
              <label>Logo</label>
              <input type="file" class="form-control" name="logo" accept="image/*">
              @if(($theme['logo_url'] ?? null))
                <div class="mt-1">
                  <img src="{{ $theme['logo_url'] }}" alt="Logo" style="max-height:64px">
                </div>
              @endif
            </div>

            <hr>

            <div class="form-group">
              <label class="font-weight-bold">Feature Flags</label>
              <div class="custom-control custom-switch mb-50">
                <input type="checkbox" class="custom-control-input" id="f-mfa" name="feature_mfa" value="1" @checked(($features['mfa'] ?? false))>
                <label class="custom-control-label" for="f-mfa">Enable MFA</label>
              </div>
              <div class="custom-control custom-switch mb-50">
                <input type="checkbox" class="custom-control-input" id="f-billing" name="feature_billing" value="1" @checked(($features['billing'] ?? false))>
                <label class="custom-control-label" for="f-billing">Enable Billing</label>
              </div>
              <div class="custom-control custom-switch mb-50">
                <input type="checkbox" class="custom-control-input" id="f-pos" name="feature_pos" value="1" @checked(($features['enable_pos'] ?? ($features['pos'] ?? false)))>
                <label class="custom-control-label" for="f-pos">Enable POS</label>
              </div>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="f-ecom" name="feature_ecommerce" value="1" @checked(($features['enable_ecommerce'] ?? ($features['ecommerce'] ?? false)))>
                <label class="custom-control-label" for="f-ecom">Enable Ecommerce</label>
              </div>
            </div>

            <div class="form-group">
              <label>Storage Quota (MB)</label>
              <input type="number" class="form-control" min="0" step="1" name="storage_quota_mb" value="{{ data_get($tenant->settings,'quotas.storage_quota_mb', 0) }}" placeholder="0 = unlimited">
            </div>

            <div class="d-flex" style="gap:10px;">
              <button type="submit" class="btn btn-primary">
                <i data-feather="save" class="mr-50"></i>Save
              </button>
              <a href="{{ route('tenancy.admin.tenants.show', ['id' => $tenant->id]) }}" class="btn btn-outline-secondary">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-5 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Preview</h4></div>
        <div class="card-body">
          <div class="d-flex align-items-center" style="gap:12px;">
            <div style="width:34px;height:34px;border-radius:10px;background:{{ $theme['primary'] ?? '#3b82f6' }};"></div>
            <div>
              <div class="font-weight-bold">{{ $tenant->name }}</div>
              <div class="text-muted"><code>{{ $tenant->slug }}</code></div>
            </div>
          </div>
          <hr>
          <p class="mb-0 text-muted">API: <code>/api/v1/theme/config</code> returns the final tokens for the active tenant.</p>
        </div>
      </div>
    </div>
  </div>
@endsection
