@extends('coreauth::layouts.base')

@section('content')
<h2>Register</h2>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="row">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>
    <div class="row">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="row">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    <div class="row">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Create Account</button>
</form>
<p class="muted" style="margin-top:8px;">Already have an account? <a href="{{ route('login') }}">Login</a></p>
@endsection

