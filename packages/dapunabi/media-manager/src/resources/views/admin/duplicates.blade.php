@extends('coreauth::layouts.base')

@section('content')
  <h2 style="margin:0 0 12px;">Duplicate Files</h2>
  <div class="muted">Scope: {{ strtoupper($scope) }}</div>
  @if(empty($byHash))
    <p>No duplicates found.</p>
  @else
    @foreach($byHash as $hash => $items)
      <div class="card" style="margin:10px 0;">
        <div><strong>Hash:</strong> {{ $hash }}</div>
        <ul>
          @foreach($items as $m)
            <li>
              #{{ $m->id }} — {{ $m->original_name ?? $m->filename }} ({{ number_format($m->size/1024,1) }} KB)
              <a href="{{ route('media.admin.show',['id'=>$m->id]) }}">open</a>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  @endif
@endsection

