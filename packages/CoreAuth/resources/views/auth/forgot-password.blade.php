@extends('coreauth::layouts.base')

@section('content')
<h2>Forgot Password</h2>
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="row">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <button type="submit">Send Reset Link</button>
</form>
@endsection

