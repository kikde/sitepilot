@extends('coreauth::layouts.base')

@section('content')
  <h2>Invoices</h2>
  @if($invoices->isEmpty())
    <p>No invoices found.</p>
  @else
    <table border="1" cellpadding="6" cellspacing="0">
      <thead>
        <tr>
          <th>#</th>
          <th>Number</th>
          <th>Status</th>
          <th>Amount</th>
          <th>Currency</th>
          <th>Issued</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($invoices as $inv)
          <tr>
            <td>{{ $inv->id }}</td>
            <td>{{ $inv->number }}</td>
            <td>{{ strtoupper($inv->status) }}</td>
            <td>{{ number_format($inv->amount, 2) }}</td>
            <td>{{ $inv->currency }}</td>
            <td>{{ $inv->created_at }}</td>
            <td><a href="{{ route('billing.invoices.download', ['id' => $inv->id]) }}">Download PDF</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
  <div style="margin-top:12px;"><a href="{{ route('billing') }}">Back to Billing</a></div>
@endsection
