@extends('layouts.app')

@section('content')
<style>
/* -------- Pretty, mobile-friendly image picker (breadcrumb) -------- */
.breadcrumb-uploader{
  border: 2px dashed #e5e7eb;
  border-radius: 14px;
  background:#fafafa;
  padding: 12px;
}
.breadcrumb-uploader .pick{
  position: relative;
  width: 100%;
  max-width: 520px;
  aspect-ratio: 16/9;           /* keeps a nice banner shape on mobile/desktop */
  border-radius: 12px;
  overflow: hidden;
  background:#f3f4f6 center/cover no-repeat;
  cursor: pointer;
  display: grid;
  place-items: center;
}
.breadcrumb-uploader .pick .overlay{
  position:absolute; inset:0;
  display:flex; align-items:center; justify-content:center;
  background: linear-gradient(to top, rgba(0,0,0,.35), rgba(0,0,0,.1));
  color:#fff; font-weight:600;
  opacity:0; transition:.2s ease;
}
.breadcrumb-uploader .pick:hover .overlay{ opacity:1; }
.breadcrumb-uploader .pick .overlay span{
  display:inline-flex; align-items:center; gap:.4rem;
  background: rgba(17,24,39,.6);
  padding:.5rem .75rem; border-radius:999px;
  backdrop-filter: blur(2px);
}
.breadcrumb-uploader .hint{
  font-size:.84rem; color:#6b7280; margin-top:.5rem;
}
.breadcrumb-uploader .actions{
  margin-top:.5rem; display:flex; gap:.5rem; flex-wrap:wrap;
}
.breadcrumb-uploader .actions .btn-sm{ border-radius:10px; }

/* default placeholder pattern (subtle) */
.breadcrumb-uploader .pick.placeholder{
  background-image:
    radial-gradient(circle at 20% 20%, #ffffff 0 20px, transparent 21px),
    radial-gradient(circle at 80% 80%, #ffffff 0 20px, transparent 21px),
    linear-gradient(135deg, #eef2ff, #f5f7ff);
}
@media (max-width: 767.98px){
  .breadcrumb-uploader{ padding: 10px; }
}
</style>

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Pages</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Edit Post</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>       
    </div>

    <div class="content-body">
        <!-- Blog Edit -->
        <div class="blog-edit-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Post </h4>
                        </div>

                        <div class="card-body">
                            <!-- Form -->
                            <form class="mt-2" action="{{ url('/news-update/'.$postlist->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input id="id" type="text" class="form-control" name="id" value="{{ $postlist->id }}" hidden>

                                <div class="row">

                                    {{-- =========================
                                         HIDDEN (COMMENTED): Name
                                         =========================--}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-title">Page Title </label>
                                            <input type="text" id="blog-edit-title" class="form-control"
                                                   name="pagetitle" value="{{ $postlist->pagetitle }}"
                                                   onchange="fillslug(this.value)" placeholder="" required />
                                        </div>
                                    </div>
                                    

                                    {{-- =========================
                                         HIDDEN (COMMENTED): Slug
                                         ========================= --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Slug</label>
                                            <input type="text" id="slug" class="form-control"
                                                   name="slug" value="{{ $postlist->slug }}" />
                                        </div>
                                    </div>
                                

                                    <div class="col-md-6 col-12" hidden>
                                        <div class="form-group mb-2">
                                            <label for="page-title">Name <span class="text-danger">*</span></label>
                                            <input type="text" id="page-title" class="form-control"
                                                   name="sector_name" value="{{ $postlist->sector_name }}"
                                                   placeholder=""   />
                                        </div>
                                    </div>

                                    {{-- ==============================
                                         HIDDEN (COMMENTED): Page Keyword
                                         ==============================
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="page-keyword">Page Keyword</label>
                                            <input type="text" id="page-keyword" class="form-control"
                                                   name="pagekeyword" value="{{ $postlist->pagekeyword }}" placeholder="" />
                                        </div>
                                    </div>
                                    --}}

                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label>Description</label>
                                            <div id="blog-editor-wrapper">
                                                <input type="hidden" class="form-control" name="description" id="description" />
                                                <div id="blog-editor-container">
                                                    <div class="editor">{!! $postlist->description !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- =======================
                    Reworked Breadcrumb Image Picker (click to upload)
                    ======================= --}}
                                    <div class="col-12">
                                      @php
                                        $existingSrc = !empty($postlist->breadcrumb)
                                          ? asset('backend/uploads/'.$postlist->breadcrumb)
                                          : '';
                                      @endphp
                                      <div class="border rounded p-2 breadcrumb-uploader">
                                        <h4 class="mb-1">Breadcrumb Image</h4>

                                        <label for="breadcrumbInput" class="pick {{ $existingSrc ? '' : 'placeholder' }}" id="bcPick"
                                               role="button"
                                               aria-label="Choose breadcrumb image"
                                               style="{{ $existingSrc ? "background-image: url('{$existingSrc}');" : '' }}">
                                          <div class="overlay"><span><i data-feather="image"></i> Choose Image</span></div>
                                        </label>

                                        <input type="file" name="breadcrumb" id="breadcrumbInput" class="d-none" accept="image/*">

                                        <div class="actions">
                                          <button type="button" class="btn btn-sm btn-outline-primary" id="bcChangeBtn">
                                            <i data-feather="refresh-ccw"></i> Change
                                          </button>
                                          <button type="button" class="btn btn-sm btn-outline-secondary" id="bcClearBtn">
                                            <i data-feather="x"></i> Clear
                                          </button>
                                        </div>

                                        <div class="hint">Ideal: 1920×442 (PNG/JPG). Keep file size reasonable for faster loads.</div>
                                      </div>
                                    </div>
                                    {{-- ======================= /picker ======================= --}}

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-status">Status</label>
                                            {!! Form::select('pagestatus', Config::get('constants.pagestatus'), $postlist->pagestatus, ['class'=>"form-control", 'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <button type="submit" id="btn-submit" class="btn btn-primary mr-1">Save Changes</button>
                                         <a href="{{ url('/newsList') }}" class="btn btn-outline-secondary mt-0">Go Back</a>
                                    </div>
                                </div>
                            </form>
                            <!--/ Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Blog Edit -->
    </div>
</div>
<script>
function fillslug(val) {
  var str = (val || '').toString().trim().replace(/\s+/g, '-').toLowerCase();
  var slugEl = document.getElementById("slug");
  if (slugEl) slugEl.value = str; // slug is compulsory, keep this
}

(function(){
  const fileInput = document.getElementById('breadcrumbInput');
  const pick      = document.getElementById('bcPick');         // clickable image area (label)
  const changeBtn = document.getElementById('bcChangeBtn');    // "Change" button
  const clearBtn  = document.getElementById('bcClearBtn');     // "Clear" button
  const resetBtn  = document.getElementById('formResetBtn');   // form reset
  let lastURL = null;

  function openDialog() {
    // Reset value so selecting the SAME file still fires a change event
    if (fileInput) fileInput.value = '';
    fileInput?.click();
  }

  function setPreviewFromFile(file){
    if (!file) return;
    if (lastURL) URL.revokeObjectURL(lastURL);
    const url = URL.createObjectURL(file);
    lastURL = url;
    pick.style.backgroundImage = `url('${url}')`;
    pick.classList.remove('placeholder');
  }

  // Preview on file selection (Chrome/Firefox use 'change'; Safari sometimes 'input')
  function onFilePicked(e){
    const f = e.target?.files?.[0];
    setPreviewFromFile(f);
  }

  // Click handlers (image area & change button)
  pick?.addEventListener('click', (ev)=>{ ev.preventDefault(); openDialog(); });
  changeBtn?.addEventListener('click', (ev)=>{ ev.preventDefault(); openDialog(); });

  // Clear chosen image
  clearBtn?.addEventListener('click', (ev)=>{
    ev.preventDefault();
    if (fileInput) fileInput.value = '';
    if (lastURL) { URL.revokeObjectURL(lastURL); lastURL = null; }
    pick.style.backgroundImage = '';
    pick.classList.add('placeholder');
  });

  // Reset form restores placeholder
  resetBtn?.addEventListener('click', ()=>{
    setTimeout(()=>{
      if (fileInput) fileInput.value = '';
      if (lastURL) { URL.revokeObjectURL(lastURL); lastURL = null; }
      pick.style.backgroundImage = '';
      pick.classList.add('placeholder');
    }, 0);
  });

  // Bind both events for robustness
  fileInput?.addEventListener('change', onFilePicked);
  fileInput?.addEventListener('input',  onFilePicked);

  // ---------- QUILL INTEGRATION (images as URL, not base64) ----------
  window.addEventListener('load', function () {
    console.log('[Quill] window load fired');

    if (!window.Quill) {
      console.warn('[Quill] window.Quill not found (is quill.min.js + page-blog-edit.js loaded?)');
      return;
    }

    // find the existing Quill editor created by your theme scripts
    const editorEl = document.querySelector('#blog-editor-container .editor');
    console.log('[Quill] editorEl:', editorEl);
    if (!editorEl) return;

    let quill = null;
    try {
      quill = Quill.find(editorEl) || editorEl.__quill || null;
    } catch (e) {
      console.warn('[Quill] Quill.find error:', e);
      quill = editorEl.__quill || null;
    }
    console.log('[Quill] quill instance:', quill);
    if (!quill) return; // if this is null, Quill wasn't initialized yet

    // override image handler to upload to Laravel and insert URL
    const toolbar = quill.getModule('toolbar');
    console.log('[Quill] toolbar module:', toolbar);

    if (toolbar) {
      toolbar.addHandler('image', function () {
        console.log('[Quill] custom image handler RUN');
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';

        input.onchange = function () {
          const file = input.files && input.files[0];
          console.log('[Quill] selected file:', file);
          if (!file) return;

          const formData = new FormData();
          formData.append('image', file);

          const tokenMeta = document.querySelector('meta[name="csrf-token"]');
          const token = tokenMeta ? tokenMeta.getAttribute('content') : '';
          console.log('[Quill] csrf token:', token);

          fetch('/upload-quill-image', {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': token
            },
            credentials: 'same-origin'
          })
            .then(function (res) {
              console.log('[Quill] upload status:', res.status);
              return res.text().then(function (text) {
                console.log('[Quill] raw response (first 200 chars):', text.substring(0, 200));
                if (!res.ok) {
                  throw new Error('Upload failed with status ' + res.status);
                }
                try {
                  return JSON.parse(text);
                } catch (e) {
                  console.error('[Quill] JSON parse error:', e);
                  throw e;
                }
              });
            })
            .then(function (data) {
              console.log('[Quill] parsed JSON:', data);
              if (data && data.url) {
                const range = quill.getSelection(true) || { index: quill.getLength() };
                console.log('[Quill] inserting image at index', range.index, 'URL:', data.url);
                quill.insertEmbed(range.index, 'image', data.url, 'user');
                quill.setSelection(range.index + 1);
              }
            })
            .catch(function (err) {
              console.error('[Quill] image upload error:', err);
            });
        };

        input.click();
      });
    } else {
      console.warn('[Quill] toolbar module not found');
    }

    // put final HTML into hidden input on submit
    const submitBtn = document.getElementById('btn-submit');
    if (submitBtn) {
      submitBtn.addEventListener('click', function () {
        const descInput = document.getElementById('description');
        if (descInput) {
          descInput.value = quill.root.innerHTML;
          console.log('[Quill] description length:', descInput.value.length);
        }
      });
    }
  });
  // -------------------------------------------------------------------

  // hydrate feather icons
  document.addEventListener('DOMContentLoaded', function(){
    if (window.feather) feather.replace();
  });
})();
</script>


@endsection
