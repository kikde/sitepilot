@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Domains</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('tenancy.admin.tenants.index') }}">Tenants</a></li>
              <li class="breadcrumb-item"><a href="{{ route('tenancy.admin.tenants.show', ['id' => $tenant->id]) }}">{{ $tenant->name }}</a></li>
              <li class="breadcrumb-item active">Domains</li>
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
    <div class="col-lg-4 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Add Domain</h4></div>
        <div class="card-body">
          <form method="post" action="{{ route('tenancy.admin.tenants.domains.add', ['id' => $tenant->id]) }}">
            @csrf
            <div class="form-group">
              <label for="domain">Domain</label>
              <input id="domain" type="text" class="form-control" name="domain" placeholder="example.com" required>
              <small class="text-muted">Use your real domain or local domain (like tenant3.test).</small>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
              <i data-feather="plus" class="mr-50"></i>Add
            </button>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Verification</h4></div>
        <div class="card-body">
          <p class="text-muted mb-0">For local Laragon you can mark domains verified by importing DB or running your verifier command.</p>
          <div class="mt-1">
            <code>php artisan tenancy:verify-domains --simulate</code>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Existing Domains</h4></div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>Domain</th>
                <th>Status</th>
                <th>Verified At</th>
                <th>Token</th>
              </tr>
            </thead>
            <tbody>
              @forelse($domains as $d)
                <tr>
                  <td><code>{{ $d->domain }}</code></td>
                  <td><span class="badge badge-light-primary">{{ strtoupper($d->status) }}</span></td>
                  <td>{{ $d->verified_at }}</td>
                  <td><code style="font-size:12px;">{{ $d->verification_token }}</code></td>
                </tr>
              @empty
                <tr><td colspan="4" class="text-center py-2">No domains yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-body border-top">
          <p class="mb-0 text-muted">DNS TXT: <code>_tenancy.&lt;domain&gt;</code> = token, or file: <code>/.well-known/tenancy-verify.txt</code></p>
        </div>
      </div>
    </div>
  </div>
@endsection
