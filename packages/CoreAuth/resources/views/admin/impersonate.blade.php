@extends('coreauth::layouts.base')

@section('content')
<div class="header" style="margin-bottom:8px;">
  <h2 style="margin:0;">Impersonation</h2>
  <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
</div>

@if(session('status'))<div class="flash">{{ session('status') }}</div>@endif

<table style="width:100%; border-collapse:collapse;">
  <thead>
    <tr>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Name</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Email</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $u)
    <tr>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $u->name }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $u->email }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">
        <form method="POST" action="/admin/impersonate/{{ $u->id }}">
          @csrf
          <button type="submit">Impersonate</button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

@if(session('impersonator_id'))
  <form method="POST" action="/admin/impersonate/stop" style="margin-top:12px;">
    @csrf
    <button type="submit">Stop Impersonation</button>
  </form>
@endif
@endsection

