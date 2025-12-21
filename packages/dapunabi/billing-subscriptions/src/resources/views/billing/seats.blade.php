@extends('coreauth::layouts.base')

@section('content')
  <h2>Seats</h2>
  @if(session('status'))
    <div style="background:#dcfce7;color:#166534;padding:8px;border-radius:6px;margin-bottom:10px;">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div style="background:#fee2e2;color:#991b1b;padding:8px;border-radius:6px;margin-bottom:10px;">
      {{ $errors->first() }}
    </div>
  @endif

  @php
    $allowedTxt = is_null($allowed) ? 'Unlimited' : $allowed;
    $insufficient = !is_null($allowed) && $used >= $allowed;
  @endphp

  <div style="margin-bottom:12px;">
    <strong>Tenant:</strong> {{ $tenant->name }} ({{ $tenant->slug }})
  </div>
  <div>
    <strong>Seats used:</strong> {{ $used }} / {{ $allowedTxt }}
    @if($insufficient)
      <div style="margin-top:8px; background:#fef9c3;color:#854d0e;padding:8px;border-radius:6px;">
        No seats available. <a href="{{ route('billing') }}">Upgrade plan</a> or release a seat below.
      </div>
    @endif
  </div>

  <h3 style="margin-top:16px;">Assigned seats</h3>
  @if($seats->isEmpty())
    <p>No seats assigned yet.</p>
  @else
    <table border="1" cellpadding="6" cellspacing="0">
      <thead>
        <tr>
          <th>User</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($seats as $seat)
          @php $u = $users->get($seat->user_id); @endphp
          <tr>
            <td>{{ $u?->name ?? ('User #'.$seat->user_id) }} ({{ $u?->email ?? 'no-email' }})</td>
            <td>
              <form method="POST" action="{{ route('billing.seats.release') }}" onsubmit="return confirm('Release seat?');" style="display:inline-block;">
                @csrf
                <input type="hidden" name="user_id" value="{{ $seat->user_id }}" />
                <button type="submit">Release</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

  <h3 style="margin-top:16px;">Assign seat</h3>
  <form method="POST" action="{{ route('billing.seats.assign') }}" style="display:flex; gap:8px; align-items:flex-end; flex-wrap:wrap;">
    @csrf
    <div>
      <label>Email</label><br>
      <input type="email" name="email" placeholder="user@example.com" />
    </div>
    <div>
      <label>or User ID</label><br>
      <input type="number" name="user_id" min="1" />
    </div>
    <div>
      <button type="submit" {{ $insufficient ? 'disabled' : '' }}>Assign</button>
    </div>
  </form>

  <div style="margin-top:12px;"><a href="{{ route('billing') }}">Back to Billing</a></div>
@endsection
