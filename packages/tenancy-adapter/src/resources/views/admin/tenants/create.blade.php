@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Create Tenant</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('tenancy.admin.tenants.index') }}">Tenants</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <form method="post" action="{{ route('tenancy.admin.tenants.store') }}">
        @csrf

        <div class="form-group">
          <label for="t-name">Name</label>
          <input id="t-name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label for="t-slug">Slug (optional)</label>
          <input id="t-slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" placeholder="tenant1.test (or leave blank)">
          <small class="text-muted">This is also used as the default domain slug.</small>
        </div>

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0" style="padding-left:18px;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="d-flex" style="gap:10px;">
          <button type="submit" class="btn btn-primary">
            <i data-feather="check" class="mr-50"></i>Create
          </button>
          <a href="{{ route('tenancy.admin.tenants.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
@endsection
