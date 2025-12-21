@extends('coreauth::layouts.base')

@section('content')
  <h2>Admin • Manual Invoices</h2>
  @if(session('status'))
    <div style="background:#dcfce7;color:#166534;padding:8px;border-radius:6px;margin-bottom:10px;">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div style="background:#fee2e2;color:#991b1b;padding:8px;border-radius:6px;margin-bottom:10px;">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('billing.admin.invoices.store') }}" style="margin-bottom:16px;">
    @csrf
    <div style="display:flex; gap:8px; flex-wrap:wrap; align-items:flex-end;">
      <div>
        <label>Tenant</label><br>
        @if(!empty($tenants))
          <select name="tenant_id">
            @foreach($tenants as $t)
              <option value="{{ $t->id }}">#{{ $t->id }} — {{ $t->name }} ({{ $t->slug }})</option>
            @endforeach
          </select>
        @else
          <input type="number" name="tenant_id" placeholder="Tenant ID" required>
        @endif
      </div>
      <div>
        <label>Amount</label><br>
        <input type="number" step="0.01" name="amount" value="{{ old('amount','19.00') }}" required>
      </div>
      <div>
        <label>Currency</label><br>
        <input type="text" name="currency" value="{{ old('currency', config('billing.currency','USD')) }}" />
      </div>
      <div>
        <label>Due date</label><br>
        <input type="date" name="due_date" value="{{ old('due_date') }}" />
      </div>
      <div>
        <label>Number (optional)</label><br>
        <input type="text" name="number" placeholder="INV-..." />
      </div>
      <div>
        <button type="submit">Create Invoice</button>
      </div>
    </div>
  </form>

  <table border="1" cellpadding="6" cellspacing="0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tenant</th>
        <th>Number</th>
        <th>Status</th>
        <th>Amount</th>
        <th>Due</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoices as $inv)
        <tr>
          <td>{{ $inv->id }}</td>
          <td>{{ $inv->tenant_id }}</td>
          <td>{{ $inv->number }}</td>
          <td>{{ strtoupper($inv->status) }}</td>
          <td>{{ number_format($inv->amount,2) }} {{ $inv->currency }}</td>
          <td>{{ $inv->due_date }}</td>
          <td>
            <a href="{{ route('billing.invoices.download',['id'=>$inv->id]) }}" target="_blank">PDF</a>
            @if($inv->status !== 'void')
              <form method="POST" action="{{ route('billing.admin.invoices.refund',['id'=>$inv->id]) }}" style="display:inline-block; margin-left:6px;" onsubmit="return confirm('Void invoice?');">
                @csrf
                <button type="submit">Void</button>
              </form>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

