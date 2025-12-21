@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Webhook Logs</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('billing.admin.invoices') }}">Billing Admin</a></li>
              <li class="breadcrumb-item active">Webhooks</li>
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

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title mb-0">Recent Events</h4>
      <a class="btn btn-outline-primary btn-sm" href="{{ route('billing.admin.invoices') }}">Back</a>
    </div>
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Provider</th>
            <th>Event ID</th>
            <th>Type</th>
            <th>Processed</th>
            <th>Created</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($logs as $l)
            <tr>
              <td>#{{ $l->id }}</td>
              <td><span class="badge badge-light-primary">{{ strtoupper($l->provider) }}</span></td>
              <td style="max-width:300px;"><code>{{ $l->event_id }}</code></td>
              <td>{{ $l->type }}</td>
              <td>{{ $l->processed_at }}</td>
              <td>{{ $l->created_at }}</td>
              <td class="text-right">
                <form method="POST" action="{{ route('billing.admin.webhooks.replay',['id'=>$l->id]) }}" class="d-inline-block">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-secondary">Replay</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="7" class="text-center py-2">No logs</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection

