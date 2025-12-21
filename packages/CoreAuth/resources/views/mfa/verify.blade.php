@extends('coreauth::layouts.base')

@section('content')
<h2>MFA Verification</h2>
<p class="muted">Enter the 6‑digit code from your authenticator app or a recovery code.</p>
<form method="POST" action="/mfa/verify">
  @csrf
  <div class="row">
    <label>Code</label>
    <input type="text" name="code" required>
  </div>
  <button type="submit">Verify</button>
@endsection

