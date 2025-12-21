@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Billing</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Billing</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-3 col-12 mb-2 text-right">
      <a class="btn btn-outline-primary btn-sm" href="{{ route('billing.invoices') }}">Invoices</a>
      <a class="btn btn-outline-primary btn-sm" href="{{ route('billing.seats') }}">Seats</a>
    </div>
  </div>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  @if(!$tenantId)
    <div class="alert alert-warning">
      No tenant context resolved. Please select a tenant first: <a href="{{ route('tenant.select') }}">Tenant Selector</a>
    </div>
  @else
    @php
      $active = $subs->firstWhere('status','active') ?? $subs->first();
      $status = $active?->status ?? null;
      $statusBadge = $status === 'active' ? 'badge-light-success' : ($status === 'past_due' ? 'badge-light-warning' : 'badge-light-secondary');
    @endphp

    <div class="row">
      <div class="col-lg-5 col-12">
        <div class="card">
          <div class="card-header"><h4 class="card-title mb-0">Current Subscription</h4></div>
          <div class="card-body">
            @if(!$active)
              <p class="mb-0">No active subscription yet.</p>
              <small class="text-muted">Pick a plan below to activate billing and seats.</small>
            @else
              <div class="d-flex justify-content-between align-items-center mb-1">
                <div><span class="text-muted">Plan</span></div>
                <div class="font-weight-bold"><code>{{ $active->plan_code }}</code></div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-1">
                <div><span class="text-muted">Status</span></div>
                <div><span class="badge {{ $statusBadge }}">{{ strtoupper($status) }}</span></div>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <div><span class="text-muted">Period</span></div>
                <div class="font-weight-bold">{{ $active->current_period_start }} → {{ $active->current_period_end }}</div>
              </div>
              @if($status === 'past_due')
                <div class="alert alert-warning mt-2 mb-0">
                  Payment overdue. Please renew to avoid suspension.
                </div>
              @endif
            @endif
          </div>
        </div>
      </div>

      <div class="col-lg-7 col-12">
        <div class="card">
          <div class="card-header"><h4 class="card-title mb-0">Available Plans</h4></div>
          <div class="card-body">
            <div class="row">
              @foreach($plans as $p)
                <div class="col-md-6 col-12">
                  <div class="card border">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h5 class="mb-0">{{ $p->name }}</h5>
                          <small class="text-muted">{{ ucfirst($p->interval) }}</small>
                        </div>
                        <div class="text-right">
                          <div class="font-weight-bolder" style="font-size:20px;">
                            {{ number_format($p->price, 2) }} <small>{{ $p->currency }}</small>
                          </div>
                          <small class="text-muted">Seats: {{ $p->seat_limit ?? 'Unlimited' }}</small>
                        </div>
                      </div>
                      <div class="d-flex flex-wrap mt-1" style="gap:10px;">
                        <form method="POST" action="{{ route('billing.checkout.local') }}">
                          @csrf
                          <input type="hidden" name="plan_code" value="{{ $p->code }}" />
                          <button class="btn btn-primary btn-sm" type="submit">Pay (Local)</button>
                        </form>
                        @if(config('billing.stripe.secret'))
                          <form method="POST" action="{{ route('billing.checkout') }}">
                            @csrf
                            <input type="hidden" name="plan_code" value="{{ $p->code }}" />
                            <button class="btn btn-outline-primary btn-sm" type="submit">Pay (Stripe)</button>
                          </form>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection

