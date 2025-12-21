@extends('coreauth::layouts.base')

@section('content')
<h2>Reset Password</h2>
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="row">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $email ?? '') }}" required>
    </div>
    <div class="row">
        <label>New Password</label>
        <input type="password" name="password" required>
    </div>
    <div class="row">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Update Password</button>
@endsection

