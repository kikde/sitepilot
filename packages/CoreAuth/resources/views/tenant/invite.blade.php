@extends('coreauth::layouts.base')

@section('content')
<div class="header" style="margin-bottom:8px;">
  <h2 style="margin:0;">Invite to Tenant ({{ $tenant->name }})</h2>
  <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
  </div>

@if(session('status'))<div class="flash">{{ session('status') }}</div>@endif

<form method="POST" action="{{ route('tenant.invite') }}" style="margin-bottom:16px;">
  @csrf
  <div class="row">
    <label>Email to invite</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
  </div>
  <div class="row">
    <label>Role</label>
    <select name="role_slug" style="padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; width:100%">
      @foreach($roles as $role)
        <option value="{{ $role->slug }}">{{ $role->slug }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit">Create Invite</button>
</form>

<h3 style="margin:0 0 8px;">Pending Invites</h3>
<table style="width:100%; border-collapse:collapse;">
  <thead>
    <tr>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Email</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Role</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Link</th>
      <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Status</th>
    </tr>
  </thead>
  <tbody>
  @forelse($invites as $inv)
    <tr>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $inv->email }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $inv->role_slug }}</td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">
        <a href="{{ url('/tenant/invite/accept/'.$inv->token) }}">Accept URL</a>
      </td>
      <td style="padding:6px; border-bottom:1px solid #f3f4f6;">@if($inv->accepted_at) Accepted @else Pending @endif</td>
    </tr>
  @empty
    <tr><td colspan="4" class="muted" style="padding:6px;">No invites</td></tr>
  @endforelse
  </tbody>
</table>
@endsection

