@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Billing Admin</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Invoices</li>
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
        <div class="card-header"><h4 class="card-title mb-0">Create Manual Invoice</h4></div>
        <div class="card-body">
          <form method="POST" action="{{ route('billing.admin.invoices.store') }}">
            @csrf
            <div class="form-group">
              <label>Tenant</label>
              @if(!empty($tenants))
                <select class="form-control" name="tenant_id">
                  @foreach($tenants as $t)
                    <option value="{{ $t->id }}">#{{ $t->id }} — {{ $t->name }} ({{ $t->slug }})</option>
                  @endforeach
                </select>
              @else
                <input class="form-control" type="number" name="tenant_id" placeholder="Tenant ID" required>
              @endif
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input class="form-control" type="number" step="0.01" name="amount" value="{{ old('amount','19.00') }}" required>
            </div>
            <div class="form-group">
              <label>Currency</label>
              <input class="form-control" type="text" name="currency" value="{{ old('currency', config('billing.currency','USD')) }}">
            </div>
            <div class="form-group">
              <label>Due date</label>
              <input class="form-control" type="date" name="due_date" value="{{ old('due_date') }}">
            </div>
            <div class="form-group">
              <label>Number (optional)</label>
              <input class="form-control" type="text" name="number" placeholder="INV-...">
            </div>
            <button class="btn btn-primary btn-block" type="submit">Create Invoice</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">Recent Invoices</h4>
          <a class="btn btn-outline-primary btn-sm" href="{{ route('billing.admin.webhooks') }}">Webhook Logs</a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tenant</th>
                <th>Number</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Due</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($invoices as $inv)
                @php
                  $s = strtolower((string)$inv->status);
                  $badge = $s === 'paid' ? 'badge-light-success' : ($s === 'due' ? 'badge-light-warning' : 'badge-light-secondary');
                @endphp
                <tr>
                  <td>#{{ $inv->id }}</td>
                  <td>{{ $inv->tenant_id }}</td>
                  <td><code>{{ $inv->number }}</code></td>
                  <td><span class="badge {{ $badge }}">{{ strtoupper($inv->status) }}</span></td>
                  <td>{{ number_format($inv->amount,2) }} {{ $inv->currency }}</td>
                  <td>{{ $inv->due_date }}</td>
                  <td class="text-right">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('billing.invoices.download',['id'=>$inv->id]) }}" target="_blank">PDF</a>
                    @if($inv->status !== 'void')
                      <form method="POST" action="{{ route('billing.admin.invoices.refund',['id'=>$inv->id]) }}" class="d-inline-block" onsubmit="return confirm('Void invoice?');">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger" type="submit">Void</button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

