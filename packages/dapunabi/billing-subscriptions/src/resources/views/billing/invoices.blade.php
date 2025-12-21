@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Invoices</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('billing') }}">Billing</a></li>
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

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title mb-0">Your Invoices</h4>
      <a class="btn btn-outline-primary btn-sm" href="{{ route('billing') }}">Back</a>
    </div>
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Number</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Due</th>
            <th class="text-right">Download</th>
          </tr>
        </thead>
        <tbody>
          @forelse($invoices as $inv)
            @php
              $s = strtolower((string)$inv->status);
              $badge = $s === 'paid' ? 'badge-light-success' : ($s === 'due' ? 'badge-light-warning' : 'badge-light-secondary');
            @endphp
            <tr>
              <td>#{{ $inv->id }}</td>
              <td><code>{{ $inv->number }}</code></td>
              <td><span class="badge {{ $badge }}">{{ strtoupper($inv->status) }}</span></td>
              <td>{{ number_format($inv->amount,2) }} {{ $inv->currency }}</td>
              <td>{{ $inv->due_date }}</td>
              <td class="text-right">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('billing.invoices.download',['id'=>$inv->id]) }}" target="_blank">PDF</a>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center py-2">No invoices.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection

