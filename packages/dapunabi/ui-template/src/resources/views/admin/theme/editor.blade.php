@extends('coreauth::layouts.base')

@section('content')
  <div class="container py-4">
    <h2>UI Template — Theme Editor</h2>
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="row">
      <div class="col-md-6">
        <form method="post" action="{{ route('uitpl.admin.theme.update') }}">
          @csrf
          <div class="mb-2">
            <label class="form-label">Tokens (JSON)</label>
            <textarea name="tokens" id="tokens" class="form-control" rows="12">@json($tokens, JSON_PRETTY_PRINT)</textarea>
            <small class="text-muted">Common keys: primary, secondary, success, error, warning, info, background, surface</small>
          </div>
          <button type="submit" class="btn btn-primary">Save Theme</button>
          <a href="{{ route('uitpl.api.theme') }}" class="btn btn-link" target="_blank">View /api/v1/theme/config</a>
        </form>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Live Preview</div>
          <div class="card-body">
            <style id="preview-vars">
@foreach($cssVars as $k => $v)
:root { {{ $k }}: {{ $v }}; }
@endforeach
            </style>
            <div id="preview" style="border:1px solid #ddd; padding:16px; border-radius:8px;">
              <h4 style="color: var(--primary)">Primary Heading</h4>
              <p>This box reflects your current theme tokens via CSS variables.</p>
              <button class="btn" style="background: var(--primary); color: white;">Primary</button>
              <button class="btn" style="background: var(--secondary); color: white;">Secondary</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      const ta = document.getElementById('tokens');
      const styleEl = document.getElementById('preview-vars');
      function updatePreview() {
        try {
          const json = JSON.parse(ta.value || '{}');
          const css = Object.entries(json)
            .filter(([k,v]) => typeof v === 'string')
            .map(([k,v]) => `:root { --${String(k).replaceAll('_','-')}:${v}; }`)
            .join('\n');
          styleEl.textContent = css;
        } catch (e) { /* ignore */ }
      }
      ta.addEventListener('input', updatePreview);
    </script>
  </div>
@endsection
