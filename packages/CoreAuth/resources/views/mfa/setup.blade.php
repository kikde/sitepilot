@extends('coreauth::layouts.base')

@section('content')
<h2>MFA Setup (TOTP)</h2>
@if($user->mfa_enabled)
  <p class="muted">MFA is enabled for your account.</p>
  <p class="muted">Keep your recovery codes safe.</p>
@else
  <p>Scan this QR code with Google Authenticator or Authy, or enter the secret manually.</p>
  <div style="display:flex; gap:16px; align-items:center;">
    <img src="{{ $qr }}" alt="QR code" width="180" height="180" style="border:1px solid #e5e7eb; border-radius:8px;">
    <div>
      <div class="muted">Secret</div>
      <div style="font-family:monospace; font-size:1.1rem;">{{ $secret }}</div>
      <div class="muted" style="margin-top:6px; word-break:break-all;">URI: {{ $otpauth }}</div>
    </div>
  </div>
  <form method="POST" action="/mfa/setup" style="margin-top:12px;">
    @csrf
    <input type="hidden" name="secret" value="{{ $secret }}">
    <div class="row">
      <label>Enter code from app</label>
      <input type="text" name="code" required>
    </div>
    <button type="submit">Enable MFA</button>
  </form>
@endif
@endsection

