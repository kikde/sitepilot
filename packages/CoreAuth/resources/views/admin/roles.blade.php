@extends('coreauth::layouts.base')

@section('content')
<h2>Roles Management (Tenant: {{ $tenant->name }})</h2>
<form method="POST" action="{{ route('admin.roles') }}">
    @csrf
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">User</th>
                @foreach($roles as $role)
                    <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">{{ $role->slug }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @php $userRoles = collect($assignments->get($user->id, []))->pluck('role_slug')->all(); @endphp
            <tr>
                <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $user->name }}<div class="muted">{{ $user->email }}</div></td>
                @foreach($roles as $role)
                    <td style="padding:6px; border-bottom:1px solid #f3f4f6;">
                        <input type="checkbox" name="roles[{{ $user->id }}][]" value="{{ $role->slug }}" {{ in_array($role->slug, $userRoles) ? 'checked' : '' }}>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="margin-top:12px;"><button type="submit">Save</button></div>
    <p class="muted" style="margin-top:8px;">Superadmin role grants all permissions.</p>
    <p class="muted">Use <a href="{{ route('admin.permissions') }}">Permissions</a> to map role → permission.</p>
@endsection

