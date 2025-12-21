@extends('coreauth::layouts.base')

@section('content')
<h2>Profile</h2>
<form method="POST" action="{{ route('account.profile') }}">
    @csrf
    <div class="row">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    </div>
    <div class="row">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>
    <div class="row">
        <label>New Password (optional)</label>
        <input type="password" name="password">
    </div>
    <div class="row">
        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation">
    </div>
    <button type="submit">Save Changes</button>
</form>
@endsection

