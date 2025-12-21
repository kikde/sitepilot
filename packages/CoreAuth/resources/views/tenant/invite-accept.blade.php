@extends('coreauth::layouts.base')

@section('content')
<div class="header" style="margin-bottom:8px;">
  <h2 style="margin:0;">Accept Invite</h2>
  <a href="{{ url()->previous() ?: route('dashboard') }}">← Back</a>
</div>

@if($errors->any())
  <div class="error">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
  </div>
@endif
@if(session('status'))<div class="flash">{{ session('status') }}</div>@endif

<p class="muted">You are accepting an invite for <strong>{{ $invite->email }}</strong> with role <strong>{{ $invite->role_slug }}</strong>.</p>
<form method="POST" action="{{ url('/tenant/invite/accept') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $invite->token }}">
  <button type="submit">Accept Invite</button>
</form>

@endsection

