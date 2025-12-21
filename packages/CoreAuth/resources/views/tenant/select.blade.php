@extends('coreauth::layouts.base')

@section('content')
<h2>Select Tenant</h2>
@if($tenants->isEmpty())
  <p class="muted">No tenants assigned to your user yet.</p>
@else
  <form method="POST" action="{{ route('tenant.select') }}">
    @csrf
    <div class="row">
      <label>Tenant</label>
      <select name="tenant_id" style="padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; width:100%">
        @foreach($tenants as $t)
          <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->slug }})</option>
        @endforeach
      </select>
    </div>
    <button type="submit">Use Tenant</button>
  </form>
@endif
@endsection

