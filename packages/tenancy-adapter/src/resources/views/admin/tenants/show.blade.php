@extends('coreauth::layouts.base')

@section('content')
  @php
    $status = $tenant->status ?? 'active';
    $badge = $status === 'active' ? 'badge-light-success' : ($status === 'suspended' ? 'badge-light-danger' : 'badge-light-warning');
    $primary = $theme['primary'] ?? '#3b82f6';
    $preset = $theme['preset'] ?? 'default';
  @endphp

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">{{ $tenant->name }}</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('tenancy.admin.tenants.index') }}">Tenants</a></li>
              <li class="breadcrumb-item active">#{{ $tenant->id }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-3 col-12 mb-2 text-right">
      <a class="btn btn-outline-primary btn-sm" href="{{ route('tenancy.admin.tenants.domains', ['id' => $tenant->id]) }}">Domains</a>
      <a class="btn btn-primary btn-sm" href="{{ route('tenancy.admin.tenants.theme', ['id' => $tenant->id]) }}">Theme</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Overview</h4></div>
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-1">
            <div><span class="text-muted">Tenant ID</span></div>
            <div class="font-weight-bold">#{{ $tenant->id }}</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-1">
            <div><span class="text-muted">Slug</span></div>
            <div><code>{{ $tenant->slug }}</code></div>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-1">
            <div><span class="text-muted">Status</span></div>
            <div><span class="badge {{ $badge }}">{{ strtoupper($status) }}</span></div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div><span class="text-muted">Users</span></div>
            <div class="font-weight-bold">{{ $usersCount }}</div>
          </div>
          <hr>
          <div class="d-flex flex-wrap" style="gap:10px;">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('tenancy.admin.tenants.domains', ['id' => $tenant->id]) }}">Manage Domains</a>
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('tenancy.admin.tenants.theme', ['id' => $tenant->id]) }}">Edit Theme & Features</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Theme Preview</h4></div>
        <div class="card-body">
          <div class="d-flex align-items-center" style="gap:14px;">
            <div style="width:34px;height:34px;border-radius:10px;background:{{ $primary }};"></div>
            <div>
              <div class="font-weight-bold">Preset: <code>{{ $preset }}</code></div>
              <div class="text-muted">Primary: <code>{{ $primary }}</code></div>
            </div>
          </div>
          @if(($theme['logo_url'] ?? null))
            <div class="mt-2">
              <img src="{{ $theme['logo_url'] }}" alt="Logo" style="max-height:56px">
            </div>
          @endif
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">Domains</h4>
          <a class="btn btn-outline-primary btn-sm" href="{{ route('tenancy.admin.tenants.domains', ['id' => $tenant->id]) }}">Manage</a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr><th>Domain</th><th>Status</th><th>Verified At</th></tr>
            </thead>
            <tbody>
              @forelse($tenant->domains as $d)
                <tr>
                  <td><code>{{ $d->domain }}</code></td>
                  <td><span class="badge badge-light-primary">{{ strtoupper($d->status) }}</span></td>
                  <td>{{ $d->verified_at }}</td>
                </tr>
              @empty
                <tr><td colspan="3" class="text-center py-2">No domains.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
