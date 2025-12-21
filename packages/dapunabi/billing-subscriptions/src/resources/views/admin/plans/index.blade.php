@extends('coreauth::layouts.base')

@section('content')
  <h2>Billing Plans</h2>
  @if(session('status'))
    <div style="background:#dcfce7;color:#166534;padding:8px;border-radius:6px;margin-bottom:10px;">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('billing.admin.plans.store') }}" style="margin-bottom:16px;">
    @csrf
    <div style="display:flex; gap:8px; flex-wrap:wrap; align-items:flex-end;">
      <div>
        <label>Code</label><br>
        <input type="text" name="code" value="{{ old('code') }}" required>
      </div>
      <div>
        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
      </div>
      <div>
        <label>Interval</label><br>
        <select name="interval">
          <option value="monthly">Monthly</option>
          <option value="yearly">Yearly</option>
        </select>
      </div>
      <div>
        <label>Price</label><br>
        <input type="number" step="0.01" name="price" value="{{ old('price', '19.00') }}" required>
      </div>
      <div>
        <button type="submit">Create Plan</button>
      </div>
    </div>
    @error('code')<div style="color:#991b1b;">{{ $message }}</div>@enderror
    @error('name')<div style="color:#991b1b;">{{ $message }}</div>@enderror
    @error('interval')<div style="color:#991b1b;">{{ $message }}</div>@enderror
    @error('price')<div style="color:#991b1b;">{{ $message }}</div>@enderror
  </form>

  <table border="1" cellpadding="6" cellspacing="0">
    <thead>
      <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Interval</</th>
        <th>Price</th>
        <th>Currency</th>
        <th>Active</th>
      </tr>
    </thead>
    <tbody>
      @foreach($plans as $p)
        <tr>
          <td>{{ $p->code }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ $p->interval }}</td>
          <td>{{ number_format($p->price, 2) }}</td>
          <td>{{ $p->currency }}</td>
          <td>{{ $p->active ? 'Yes' : 'No' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div style="margin-top:12px;"><a href="{{ route('billing') }}">Go to /billing</a></div>
@endsection
