@extends('coreauth::layouts.base')

@section('content')
  <h2>Billing</h2>
  @if(session('status'))
    <div style="background:#dcfce7;color:#166534;padding:8px;border-radius:6px;margin-bottom:10px;">{{ session('status') }}</div>
  @endif
  @if(!$tenantId)
    <p>No tenant context resolved. Select a tenant first.</p>
    <p><a href="{{ route('tenant.select') }}">/tenant/select</a></p>
  @else
    <div style="margin-bottom:12px;">
      <strong>Current Subscriptions</strong>
      @if($subs->isEmpty())
        <p>No active subscriptions.</p>
      @else
        <ul>
          @foreach($subs as $s)
            <li>{{ $s->plan_code }} — {{ strtoupper($s->status) }} ({{ $s->current_period_start }} → {{ $s->current_period_end }})</li>
          @endforeach
        </ul>
      @endif
    </div>

    <div>
      <strong>Available Plans</strong>
      <ul>
        @foreach($plans as $p)
          <li>
            {{ $p->name }} ({{ $p->interval }}) — {{ number_format($p->price, 2) }} {{ $p->currency }}
            <form method="POST" action="{{ route('billing.checkout.local') }}" style="display:inline-block; margin-left:10px;">
              @csrf
              <input type="hidden" name="plan_code" value="{{ $p->code }}" />
              <button type="submit">Pay (Local)</button>
            </form>
            @if(config('billing.stripe.secret'))
              <form method="POST" action="{{ route('billing.checkout') }}" style="display:inline-block; margin-left:10px;">
                @csrf
                <input type="hidden" name="plan_code" value="{{ $p->code }}" />
                <button type="submit">Pay (Stripe)</button>
              </form>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
    <div style="margin-top:12px;">
      <a href="{{ route('billing.invoices') }}">View invoices</a>
    </div>
  @endif
@endsection
