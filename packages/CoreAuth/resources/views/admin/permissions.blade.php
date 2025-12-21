@extends('coreauth::layouts.base')

@section('content')
<h2>Permissions Matrix</h2>
<form method="POST" action="{{ route('admin.permissions') }}">
    @csrf
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">Permission</th>
                @foreach($roles as $role)
                    <th style="text-align:left; padding:6px; border-bottom:1px solid #e5e7eb;">{{ $role->slug }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($permissions as $perm)
            <tr>
                <td style="padding:6px; border-bottom:1px solid #f3f4f6;">{{ $perm->slug }}<div class="muted">{{ $perm->name }}</div></td>
                @foreach($roles as $role)
                    @php $checked = collect($matrix->get($role->slug, []))->pluck('permission_slug')->contains($perm->slug); @endphp
                    <td style="padding:6px; border-bottom:1px solid #f3f4f6;">
                        <input type="checkbox" name="perm[{{ $role->slug }}][{{ $perm->slug }}]" value="1" {{ $checked ? 'checked' : '' }}>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="margin-top:12px;"><button type="submit">Save</button></div>
    <p class="muted" style="margin-top:8px;">Superadmin implicitly has all permissions.</p>
@endsection

