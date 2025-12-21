@extends('coreauth::layouts.base')

@section('content')
  <div class="container-fluid py-3">
    <div class="d-flex align-items-center justify-content-between mb-2">
      <div>
        <h4 class="mb-0">Visual PageBuilder Editor</h4>
        <small class="text-muted">Editing slug: {{ $slug }}</small>
      </div>
      <div>
        <div class="btn-group me-2" role="group">
          <button class="btn btn-outline-secondary" id="dev-desktop">Desktop</button>
          <button class="btn btn-outline-secondary" id="dev-tablet">Tablet</button>
          <button class="btn btn-outline-secondary" id="dev-mobile">Mobile</button>
        </div>
        <button class="btn btn-secondary" id="btn-save">Save Draft</button>
        <button class="btn btn-primary" id="btn-publish">Publish</button>
      </div>
    </div>

    <div class="row" id="uitpl-editor-root">
      <div class="col-12 col-md-3 mb-3">
        <div class="card h-100">
          <div class="card-header">Blocks</div>
          <div class="list-group list-group-flush" id="block-list"></div>
        </div>
      </div>
      <div class="col-12 col-md-6 mb-3">
        <div class="card h-100">
          <div class="card-header">Canvas</div>
          <div class="card-body" id="canvas" style="min-height: 400px; background: #fafafa;"></div>
        </div>
      </div>
      <div class="col-12 col-md-3 mb-3">
        <div class="card h-100">
          <div class="card-header">Block Settings</div>
          <div class="card-body" id="inspector"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.__UI_BLOCKS = @json($manifests);
    window.__UI_PAGE = @json(['slug' => $slug, 'content' => $content]);
    window.__CSRF = '{{ csrf_token() }}';
  </script>
  <script type="module">
    // Minimal vanilla editor to avoid CDN dependency issues in some environments
    const blocks = window.__UI_BLOCKS || {};
    let content = window.__UI_PAGE.content || { blocks: [] };
    let selectedIndex = -1;

    const blockListEl = document.getElementById('block-list');
    const canvasEl = document.getElementById('canvas');
    const inspectorEl = document.getElementById('inspector');

    function renderBlockList() {
      blockListEl.innerHTML = '';
      Object.values(blocks).forEach(m => {
        const a = document.createElement('a');
        a.href = '#';
        a.className = 'list-group-item list-group-item-action';
        a.textContent = m.name || m.key;
        a.onclick = (e) => { e.preventDefault(); addBlock(m.key); };
        blockListEl.appendChild(a);
      });
    }

    function renderCanvas() {
      canvasEl.innerHTML = '';
      (content.blocks || []).forEach((b, idx) => {
        const wrap = document.createElement('div');
        wrap.className = 'mb-2 p-2 border ' + (idx === selectedIndex ? 'border-primary' : 'border-200');
        const title = document.createElement('div');
        title.className = 'd-flex justify-content-between align-items-center';
        title.innerHTML = `<strong>${b.key}</strong>
          <span>
            <button class="btn btn-sm btn-light me-1" data-act="up">↑</button>
            <button class="btn btn-sm btn-light me-1" data-act="down">↓</button>
            <button class="btn btn-sm btn-danger" data-act="remove">Remove</button>
          </span>`;
        const prev = document.createElement('div');
        prev.className = 'bg-white p-2';
        const man = blocks[b.key] || {};
        prev.innerHTML = man.preview || `<div class='text-muted'>No preview</div>`;
        wrap.appendChild(title);
        wrap.appendChild(prev);
        wrap.onclick = () => { selectedIndex = idx; renderCanvas(); renderInspector(); };
        wrap.querySelector('[data-act="up"]').onclick = (e) => { e.stopPropagation(); moveUp(idx); };
        wrap.querySelector('[data-act="down"]').onclick = (e) => { e.stopPropagation(); moveDown(idx); };
        wrap.querySelector('[data-act="remove"]').onclick = (e) => { e.stopPropagation(); removeBlock(idx); };
        canvasEl.appendChild(wrap);
      });
      if ((content.blocks || []).length === 0) {
        const empty = document.createElement('div');
        empty.className = 'text-center text-muted py-5';
        empty.textContent = 'Drag blocks here or click from the left to add.';
        canvasEl.appendChild(empty);
      }
    }

    function renderInspector() {
      inspectorEl.innerHTML = '';
      if (selectedIndex < 0 || !content.blocks[selectedIndex]) {
        inspectorEl.innerHTML = '<div class="text-muted">Select a block to edit its settings.</div>';
        return;
      }
      const b = content.blocks[selectedIndex];
      const man = blocks[b.key] || { fields: {} };
      const props = b.props || (b.props = {});
      Object.entries(man.fields || {}).forEach(([field, type]) => {
        const group = document.createElement('div');
        group.className = 'mb-2';
        const label = document.createElement('label');
        label.className = 'form-label';
        label.textContent = field;
        group.appendChild(label);
        if (type === 'string') {
          const input = document.createElement('input');
          input.className = 'form-control';
          input.value = props[field] ?? (man.defaults ? man.defaults[field] : '');
          input.oninput = (e) => { props[field] = e.target.value; };
          group.appendChild(input);
        } else {
          const ta = document.createElement('textarea');
          ta.className = 'form-control';
          ta.rows = 4;
          try { ta.value = JSON.stringify(props[field] ?? (man.defaults ? man.defaults[field] : ''), null, 2); } catch { ta.value=''; }
          ta.oninput = (e) => { try { props[field] = JSON.parse(e.target.value || 'null'); } catch {} };
          group.appendChild(ta);
        }
        inspectorEl.appendChild(group);
      });
    }

    function addBlock(key) {
      const man = blocks[key];
      const props = JSON.parse(JSON.stringify((man && man.defaults) || {}));
      content.blocks = content.blocks || [];
      content.blocks.push({ key, props });
      selectedIndex = content.blocks.length - 1;
      renderCanvas(); renderInspector();
    }
    function moveUp(idx) {
      if (idx <= 0) return;
      const arr = content.blocks;
      [arr[idx-1], arr[idx]] = [arr[idx], arr[idx-1]];
      selectedIndex = idx-1; renderCanvas(); renderInspector();
    }
    function moveDown(idx) {
      const arr = content.blocks; if (idx >= arr.length-1) return;
      [arr[idx+1], arr[idx]] = [arr[idx], arr[idx+1]];
      selectedIndex = idx+1; renderCanvas(); renderInspector();
    }
    function removeBlock(idx) {
      content.blocks.splice(idx,1);
      selectedIndex = -1; renderCanvas(); renderInspector();
    }

    async function postJson(url, data) {
      const res = await fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': window.__CSRF }, body: JSON.stringify(data) });
      if (!res.ok) throw new Error('HTTP '+res.status);
      return await res.json();
    }
    async function saveDraft() {
      try {
        await postJson('{{ route('uitpl.editor.save') }}', { slug: window.__UI_PAGE.slug, content_json: JSON.stringify(content) });
        alert('Draft saved');
      } catch (e) { alert('Save failed'); }
    }
    async function publish() {
      try {
        await postJson('{{ route('uitpl.editor.publish') }}', { slug: window.__UI_PAGE.slug, content_json: JSON.stringify(content) });
        alert('Published');
      } catch (e) { alert('Publish failed'); }
    }

    document.getElementById('btn-save').onclick = saveDraft;
    document.getElementById('btn-publish').onclick = publish;
    document.getElementById('dev-desktop').onclick = () => document.getElementById('uitpl-editor-root').style.maxWidth = '100%';
    document.getElementById('dev-tablet').onclick = () => document.getElementById('uitpl-editor-root').style.maxWidth = '900px';
    document.getElementById('dev-mobile').onclick = () => document.getElementById('uitpl-editor-root').style.maxWidth = '480px';

    // init
    renderBlockList();
    renderCanvas();
    renderInspector();
  </script>
@endsection
