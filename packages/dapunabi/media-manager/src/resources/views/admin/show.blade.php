@extends('coreauth::layouts.base')

@section('content')
  <h2 style="margin:0 0 12px;">Media Detail</h2>
  @if (session('status'))
    <div class="flash">{{ session('status') }}</div>
  @endif
  <div class="muted">ID #{{ $m->id }} • Version {{ $m->version }} • {{ $m->mime_type }} • {{ number_format($m->size/1024,1) }} KB</div>
  <div style="margin:10px 0;">
    @php $thumb = $m->variantUrl('thumb'); @endphp
    @if($m->isImage() || $thumb)
      <img src="{{ $thumb ?: $m->url() }}" alt="preview" style="max-width: 360px; border-radius: 8px; border:1px solid var(--ring)">
    @else
      <a class="btn" href="{{ route('api.media.download',['id'=>$m->id]) }}" target="_blank">Download</a>
    @endif
  </div>
  <div class="muted">Path: {{ $m->path }}</div>
  <div class="muted">Hash: {{ $m->hash ?: 'n/a' }}</div>
  <div class="muted">Visibility: <strong>{{ strtoupper($m->visibility) }}</strong></div>
  <form action="{{ route('media.admin.visibility',['id'=>$m->id]) }}" method="post" style="margin:8px 0 16px;">
    @csrf
    <select name="visibility">
      <option value="private" @selected($m->visibility==='private')>Private</option>
      <option value="shared" @selected($m->visibility==='shared')>Shared (via tokens)</option>
      <option value="public" @selected($m->visibility==='public')>Public</option>
    </select>
    <button class="btn btn-outline" type="submit">Update</button>
  </form>

  <h3 style="margin:14px 0 8px;">Replace File</h3>
  <form action="{{ route('media.admin.replace',['id'=>$m->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button class="btn" type="submit">Upload Replacement</button>
    <a class="btn btn-outline" href="{{ route('media.admin.index') }}" style="margin-left:8px;">Back</a>
  </form>

  <h3 style="margin:14px 0 8px;">Versions</h3>
  @if($versions->isEmpty())
    <div class="muted">No previous versions.</div>
  @else
    <table border="1" cellpadding="6" cellspacing="0">
      <thead><tr><th>#</th><th>Version</th><th>Mime</th><th>Size</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($versions as $v)
          <tr>
            <td>{{ $v->id }}</td>
            <td>{{ $v->version_no }}</td>
            <td>{{ $v->mime_type }}</td>
            <td>{{ number_format($v->size/1024,1) }} KB</td>
            <td>
              <a class="btn btn-outline" href="{{ url('/api/v1/media/'.$m->id.'/download') }}" target="_blank">Download Current</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

  <h3 style="margin:14px 0 8px;">Tags & Folder</h3>
  <form action="{{ route('media.admin.tags',['id'=>$m->id]) }}" method="post" style="margin-bottom:8px;">
    @csrf
    <label>Tags: <input type="text" name="tags" value="{{ implode(',', (array)($m->tags_json ?: [])) }}" placeholder="comma,separated"></label>
    <button class="btn btn-outline" type="submit">Save</button>
  </form>
  <form action="{{ route('media.admin.move',['id'=>$m->id]) }}" method="post" style="margin-bottom:8px;">
    @csrf
    <label>Folder: <input type="text" name="folder" value="{{ $m->folder }}" placeholder="folder"></label>
    <button class="btn btn-outline" type="submit">Move</button>
  </form>

  <h3 style="margin:14px 0 8px;">Share Links</h3>
  <form action="{{ route('media.admin.share',['id'=>$m->id]) }}" method="post" style="margin-bottom:8px;">
    @csrf
    <label>TTL (seconds): <input type="number" name="ttl" value="{{ config('media-manager.share_ttl_default', 86400) }}" min="60"></label>
    <button class="btn" type="submit">Create Share Link</button>
  </form>
  @if(isset($shares) && $shares->isNotEmpty())
    <table border="1" cellpadding="6" cellspacing="0">
      <thead><tr><th>Token</th><th>Expires</th><th>Downloads</th><th>Link</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($shares as $s)
          <tr>
            <td style="max-width:260px; word-break:break-all">{{ $s->token }}</td>
            <td>{{ $s->expires_at ?: 'never' }}</td>
            <td>{{ $s->downloads_count }}</td>
            <td><a href="{{ url('/media/share/'.$s->token) }}" target="_blank">Open</a></td>
            <td>
              <form action="{{ route('media.admin.share.revoke',['id'=>$m->id,'token'=>$s->token]) }}" method="post" onsubmit="return confirm('Revoke this share?');">
                @csrf
                <button class="btn btn-outline" type="submit">Revoke</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="muted">No share links yet.</div>
  @endif
@endsection
