@extends('coreauth::layouts.base')

@section('content')
  <h2 style="margin:0 0 12px;">Media Library</h2>
  <p class="muted" style="margin:0 0 12px;">Recent uploads (latest 50)</p>
  <form method="get" action="{{ route('media.admin.index') }}" style="margin:10px 0; display:flex; gap:8px; flex-wrap:wrap;">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..." style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text)">
    <input type="text" name="tag" value="{{ request('tag') }}" placeholder="Tag" style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text)">
    <input type="text" name="folder" value="{{ request('folder') }}" placeholder="Folder" style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text)">
    <select name="type" style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text)">
      <option value="">All Types</option>
      <option value="image" @selected(request('type')==='image')>Images</option>
      <option value="pdf" @selected(request('type')==='pdf')>PDFs</option>
    </select>
    <input type="number" name="size_min" value="{{ request('size_min') }}" placeholder="Min size (bytes)" style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text); width:160px;">
    <input type="number" name="size_max" value="{{ request('size_max') }}" placeholder="Max size (bytes)" style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text); width:160px;">
    <input type="date" name="date_from" value="{{ request('date_from') }}" style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text)">
    <input type="date" name="date_to" value="{{ request('date_to') }}" style="padding:8px; border-radius:8px; border:1px solid var(--ring); background:var(--panel); color:var(--text)">
    <button class="btn" type="submit">Filter</button>
    <a class="btn btn-outline" href="{{ route('media.admin.upload') }}">Upload New</a>
  </form>

  @if (session('status'))
    <div class="flash">{{ session('status') }}</div>
  @endif

  @if($items->isEmpty())
    <p>No media yet.</p>
  @else
    <style>
      .grid{display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:12px}
      .tile{border:1px solid var(--ring); border-radius:10px; padding:10px; background:var(--card)}
      .tile img{width:100%; height:120px; object-fit:cover; border-radius:8px;}
      .tile .name{font-size:.9rem; margin-top:6px; word-break:break-all}
      .tile .muted{font-size:.8rem}
    </style>
    <form action="{{ route('media.admin.bulk') }}" method="post">
      @csrf
      <div style="display:flex; gap:8px; align-items:center; margin:6px 0;">
        <select name="action" required>
          <option value="zip">Zip (queue)</option>
          <option value="delete">Delete</option>
          <option value="tag">Set Tags</option>
          <option value="move">Move Folder</option>
        </select>
        <input type="text" name="tags" placeholder="tags (comma separated)">
        <input type="text" name="folder" placeholder="folder">
        <button class="btn btn-outline" type="submit">Run</button>
        <a class="btn btn-outline" href="{{ route('media.admin.duplicates') }}">Duplicates</a>
      </div>
      <div class="grid">
      @foreach($items as $m)
        <div class="tile">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
            <label><input type="checkbox" name="ids[]" value="{{ $m->id }}"> Select</label>
            <a class="btn btn-outline" href="{{ route('media.admin.show',['id'=>$m->id]) }}">Open</a>
          </div>
          @php $isImg = $m->isImage(); $isPdf = $m->isPdf(); $thumb = $m->variantUrl('thumb'); @endphp
          @if($isImg)
            <img src="{{ $thumb ?: $m->url() }}" alt="{{ $m->original_name }}">
          @elseif($isPdf)
            @if($thumb)
              <img src="{{ $thumb }}" alt="PDF thumbnail">
            @else
              <div class="muted" style="height:120px;display:flex;align-items:center;justify-content:center;border:1px dashed var(--ring); border-radius:8px;">PDF (processing…)</div>
            @endif
          @else
            <div class="muted" style="height:120px;display:flex;align-items:center;justify-content:center;border:1px dashed var(--ring); border-radius:8px;">{{ $m->mime_type }}</div>
          @endif
          <div class="name" title="{{ $m->original_name }}">{{ $m->original_name ?? $m->filename }}</div>
          <div class="muted">{{ number_format($m->size/1024,1) }} KB</div>
          @if(!empty($m->tags_json))
            <div class="muted">#{{ implode(' #', (array)$m->tags_json) }}</div>
          @endif
          @if(($isImg || $isPdf) && empty($m->variants_json))
            <div class="muted">Processing…</div>
          @endif
        </div>
      @endforeach
      </div>
      @if($items->hasMorePages())
        <div style="margin-top:10px;">
          <a class="btn" href="{{ $items->nextPageUrl() }}">Load more</a>
        </div>
      @endif
    </form>
  @endif
@endsection
