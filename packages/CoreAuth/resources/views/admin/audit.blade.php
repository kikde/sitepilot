@extends('coreauth::layouts.base')

@section('content')
<div class="header" style="margin-bottom:8px;">
  <h2 style="margin:0;">Audit Logs</h2>
  <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
</div>

<table style="width:100%; border-collapse:collapse;">
  <thead>
    <tr>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Time</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Action</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">User</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Actor</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">IP</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Details</th>
    </tr>
  </thead>
  <tbody>
  @foreach($logs as $log)
    <tr>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $log->created_at }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $log->action }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $log->user_id }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $log->actor_id }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $log->ip }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6; font-family:monospace; max-width:380px; overflow:hidden; text-overflow:ellipsis;">{{ $log->details }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection

