@extends('coreauth::layouts.base')

@section('content')
<h2>Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="row">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="row">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    <div class="row">
        <label style="display:flex;align-items:center;gap:8px;">
            <input type="checkbox" name="remember" value="1"> Remember me
        </label>
    </div>
    <button type="submit">Sign In</button>
</form>
<p class="muted" style="margin-top:8px;"><a href="{{ route('password.request') }}">Forgot password?</a></p>
<p class="muted">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
@endsection

