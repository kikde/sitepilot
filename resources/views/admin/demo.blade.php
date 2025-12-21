@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Demo Center</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Demo</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  @php
    $users = \Illuminate\Support\Facades\DB::table('users')->select('id','name','email')->orderBy('id')->get();
    $tenants = [];
    try {
      if (\Illuminate\Support\Facades\Schema::hasTable('tenants')) {
        $tenants = \Illuminate\Support\Facades\DB::table('tenants')->select('id','name','slug','status')->orderBy('id')->get();
      }
    } catch (\Throwable $e) { $tenants = []; }
  @endphp

  <div class="row">
    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title">Quick Links</h4></div>
        <div class="card-body">
          <div class="d-flex flex-wrap" style="gap:10px;">
            <a class="btn btn-primary" href="{{ route('tenant.select') }}">Tenant Selector</a>
            <a class="btn btn-outline-primary" href="{{ url('/billing') }}">Billing</a>
            <a class="btn btn-outline-primary" href="{{ url('/admin/ui/pages') }}">UI Pages</a>
            <a class="btn btn-outline-primary" href="{{ url('/admin/media') }}">Media</a>
            <a class="btn btn-outline-primary" href="{{ url('/ngo') }}" target="_blank">Open NGO Site</a>
          </div>
          <hr>
          <p class="mb-0"><strong>Re-seed demo:</strong> run <code>php artisan demo:setup</code></p>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title">Demo Credentials</h4></div>
        <div class="card-body">
          <ul class="mb-0" style="padding-left:18px;">
            <li><strong>Superadmin</strong>: <code>{{ config('coreauth.superadmin.email') }}</code> / <code>{{ config('coreauth.superadmin.password','password') }}</code></li>
            <li><strong>Customer Tenant 1 Admin</strong>: <code>customer1@tenant1.test</code> / <code>password</code></li>
            <li><strong>Customer Tenant 2 Admin</strong>: <code>customer2@tenant2.test</code> / <code>password</code></li>
            <li><strong>Editor</strong>: <code>editor@tenant1.test</code> / <code>password</code></li>
            <li><strong>Viewer</strong>: <code>viewer@tenant1.test</code> / <code>password</code></li>
          </ul>
          <small class="text-muted d-block mt-1">If these users don’t exist yet, run <code>php artisan demo:setup</code>.</small>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title">Tenants</h4></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Open</th>
              </tr>
              </thead>
              <tbody>
              @forelse($tenants as $t)
                <tr>
                  <td>{{ $t->id }}</td>
                  <td>{{ $t->name }}</td>
                  <td><code>{{ $t->slug }}</code></td>
                  <td><span class="badge badge-light-primary">{{ strtoupper($t->status ?? 'active') }}</span></td>
                  <td><a href="https://{{ $t->slug }}/ngo" target="_blank">https://{{ $t->slug }}</a></td>
                </tr>
              @empty
                <tr><td colspan="5">No tenants table rows found.</td></tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

