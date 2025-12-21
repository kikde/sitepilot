@extends('coreauth::layouts.base')

@section('content')
<div class="header" style="margin-bottom:8px;">
  <h2 style="margin:0;">CoreAuth API v1</h2>
  <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
</div>

<p class="muted">Reference endpoints for FLANGAPP integration. Use Authorization: Bearer {token}. Set tenant via <code>X-Tenant</code> header (slug or id) if needed.</p>
<ul style="line-height:1.9;">
  <li>POST /api/v1/login — { email, password, mfa_code? } → { access_token, expires_in }</li>
  <li>POST /api/v1/logout — revoke current token</li>
  <li>POST /api/v1/refresh — refresh current token</li>
  <li>GET /api/v1/getMe — returns user + tenant</li>
  <li>GET /api/v1/getPermissions — returns permissions for current tenant</li>
</ul>
@endsection

