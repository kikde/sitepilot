@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Tenants</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Tenancy</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('status') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title mb-0">All Tenants</h4>
      <a class="btn btn-primary" href="{{ route('tenancy.admin.tenants.create') }}">
        <i data-feather="plus" class="mr-50"></i>Create Tenant
      </a>
    </div>
    <div class="card-body">
      <p class="text-muted mb-0">Manage customer websites: domains, theme preset, feature flags, and status.</p>
    </div>
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Domains</th>
            <th>Status</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tenants as $tenant)
            @php
              $status = $tenant->status ?? 'active';
              $badge = $status === 'active' ? 'badge-light-success' : ($status === 'suspended' ? 'badge-light-danger' : 'badge-light-warning');
            @endphp
            <tr>
              <td><span class="font-weight-bold">#{{ $tenant->id }}</span></td>
              <td>{{ $tenant->name }}</td>
              <td><code>{{ $tenant->slug }}</code></td>
              <td>{{ $tenant->domains()->count() }}</td>
              <td><span class="badge {{ $badge }}">{{ strtoupper($status) }}</span></td>
              <td class="text-right">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('tenancy.admin.tenants.show', ['id' => $tenant->id]) }}">View</a>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('tenancy.admin.tenants.domains', ['id' => $tenant->id]) }}">Domains</a>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('tenancy.admin.tenants.theme', ['id' => $tenant->id]) }}">Theme</a>
                <form method="post" action="{{ route('tenancy.admin.tenants.status', ['id' => $tenant->id]) }}" class="d-inline-block ml-50">
                  @csrf
                  <select name="status" class="form-control form-control-sm d-inline-block" style="width:140px" onchange="this.form.submit()">
                    @foreach(['active','suspended','pending'] as $s)
                      <option value="{{ $s }}" @selected(($tenant->status ?? 'active') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                  </select>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center py-3">No tenants yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
