@extends('coreauth::layouts.base')

@section('content')
<h2>Sessions</h2>
<p class="muted">Active sessions for your account. Revoke any you don’t recognize.</p>
<table style="width:100%; border-collapse:collapse;">
  <thead>
    <tr>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Session</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">IP</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Device</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Last Active</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Status</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($sessions as $s)
    <tr>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6; font-family:monospace;">{{ $s->session_id }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $s->ip ?? '-' }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6; max-width:320px; overflow:hidden; text-overflow:ellipsis;">{{ $s->user_agent ?? '-' }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $s->last_activity }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">@if($s->revoked_at) Revoked @else @if($s->session_id === $current) Current @else Active @endif @endif</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">
        @if(!$s->revoked_at)
          <form method="POST" action="/account/sessions/{{ $s->id }}/revoke">
            @csrf
            <button type="submit">Revoke</button>
          </form>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
@endsection

