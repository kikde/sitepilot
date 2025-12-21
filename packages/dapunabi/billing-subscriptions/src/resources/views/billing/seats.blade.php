@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Seats</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('billing') }}">Billing</a></li>
              <li class="breadcrumb-item active">Seats</li>
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

  @php
    $allowedTxt = is_null($allowed) ? 'Unlimited' : $allowed;
    $insufficient = !is_null($allowed) && $used >= $allowed;
    $pct = is_null($allowed) || $allowed == 0 ? 0 : min(100, (int) round(($used / max(1,$allowed)) * 100));
  @endphp

  <div class="row">
    <div class="col-lg-4 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Usage</h4></div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <div class="text-muted">Tenant</div>
            <div class="font-weight-bold">{{ $tenant->slug ?? $tenant->id }}</div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-1">
            <div class="text-muted">Seats used</div>
            <div class="font-weight-bold">{{ $used }} / {{ $allowedTxt }}</div>
          </div>
          <div class="progress" style="height:8px;">
            <div class="progress-bar" role="progressbar" style="width: {{ $pct }}%" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          @if($insufficient)
            <div class="alert alert-warning mt-2 mb-0">
              No seats available. <a href="{{ route('billing') }}">Upgrade plan</a> or release a seat.
            </div>
          @endif
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Assign Seat</h4></div>
        <div class="card-body">
          <form method="POST" action="{{ route('billing.seats.assign') }}">
            @csrf
            <div class="form-group">
              <label>Email</label>
              <input class="form-control" type="email" name="email" placeholder="user@example.com">
            </div>
            <div class="form-group">
              <label>or User ID</label>
              <input class="form-control" type="number" name="user_id" min="1">
            </div>
            <button class="btn btn-primary btn-block" type="submit" {{ $insufficient ? 'disabled' : '' }}>Assign</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">Assigned Seats</h4>
          <a class="btn btn-outline-primary btn-sm" href="{{ route('billing') }}">Back</a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>User</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($seats as $seat)
                @php $u = $users->get($seat->user_id); @endphp
                <tr>
                  <td>
                    <div class="font-weight-bold">{{ $u?->name ?? ('User #'.$seat->user_id) }}</div>
                    <small class="text-muted">{{ $u?->email ?? 'no-email' }}</small>
                  </td>
                  <td class="text-right">
                    <form method="POST" action="{{ route('billing.seats.release') }}" onsubmit="return confirm('Release seat?');" class="d-inline-block">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ $seat->user_id }}">
                      <button type="submit" class="btn btn-sm btn-outline-danger">Release</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="2" class="text-center py-2">No seats assigned yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

