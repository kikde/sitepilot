@extends('coreauth::layouts.base')

@section('content')
<h2>Billing</h2>
<p class="muted">Tenant: <strong>{{ $tenant->name }}</strong> ({{ $tenant->slug }})</p>
<p>Status: <strong>{{ strtoupper($tenant->license_status) }}</strong></p>
@if($errors->has('license'))
  <div class="error">{{ $errors->first('license') }}</div>
@endif
@if(session('status'))
  <div class="flash">{{ session('status') }}</div>
@endif

<h3 style="margin-top:16px;">Invoices</h3>
<table style="width:100%; border-collapse:collapse;">
  <thead>
    <tr>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">#</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Amount</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Due Date</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Status</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Action</th>
    </tr>
  </thead>
  <tbody>
  @forelse($invoices as $inv)
    <tr>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $inv->number }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $inv->currency }} {{ number_format($inv->amount, 2) }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $inv->due_date ?? '-' }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ strtoupper($inv->status) }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">
        @if($inv->status === 'due')
          <form method="POST" action="{{ route('billing.pay', ['id' => $inv->id]) }}">
            @csrf
            <button type="submit">Pay</button>
          </form>
        @else
          Paid @ {{ $inv->paid_at }}
        @endif
      </td>
    </tr>
  @empty
    <tr><td colspan="5" class="muted" style="padding:6px;">No invoices</td></tr>
  @endforelse
  </tbody>
</table>
@endsection

