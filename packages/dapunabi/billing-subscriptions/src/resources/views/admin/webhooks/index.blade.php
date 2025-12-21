@extends('coreauth::layouts.base')

@section('content')
  <h2>Admin • Webhook Logs</h2>
  @if(session('status'))
    <div style="background:#dcfce7;color:#166534;padding:8px;border-radius:6px;margin-bottom:10px;">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div style="background:#fee2e2;color:#991b1b;padding:8px;border-radius:6px;margin-bottom:10px;">{{ $errors->first() }}</div>
  @endif

  <table border="1" cellpadding="6" cellspacing="0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Provider</th>
        <th>Event ID</th>
        <th>Type</th>
        <th>Processed</th>
        <th>Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($logs as $l)
        <tr>
          <td>{{ $l->id }}</td>
          <td>{{ $l->provider }}</td>
          <td>{{ $l->event_id }}</td>
          <td>{{ $l->type }}</td>
          <td>{{ $l->processed_at }}</td>
          <td>{{ $l->created_at }}</td>
          <td>
            <form method="POST" action="{{ route('billing.admin.webhooks.replay',['id'=>$l->id]) }}" style="display:inline-block;">
              @csrf
              <button type="submit">Replay</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="7">No logs</td></tr>
      @endforelse
    </tbody>
  </table>
@endsection

