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

/* Editor & frontend content wrapper */
.ck-content .image {
    max-width: 40%;      /* image not too wide when floated */
    height: auto;
}

/* Wrap text when image aligned left */
.ck-content .image.image-style-align-left {
    float: left;
    margin: 0 1rem 0.5rem 0; /* right/bottom space around image */
}

/* Wrap text when image aligned right */
.ck-content .image.image-style-align-right {
    float: right;
    margin: 0 0 0.5rem 1rem; /* left/bottom space */
}

/* Optional: clear float after blocks if you see layout issues */
.ck-content::after {
    content: "";
    display: block;
    clear: both;
}

.breadcrumb-uploader .pick{
  position: relative;
  width: 100%;
  max-width: 520px;
  aspect-ratio: 16/9;
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Post</a></li>
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
            <div class="card-header"><h4 class="card-title">Add New Post</h4></div>

            <div class="card-body">
              <!-- Form -->
              <form class="mt-2" action="{{ url('/addnews') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                  {{-- Page title -> auto-fills slug --}}
                  <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                      <label for="blog-edit-title">Page Title</label>
                      <input type="text"
                             id="blog-edit-title"
                             class="form-control"
                             name="pagetitle"
                             onchange="fillslug(this.value)"
                             placeholder=""
                             value="{{ old('pagetitle') }}" />
                    </div>
                  </div>

                  {{-- Slug --}}
                  <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                      <label for="blog-edit-slug">Slug</label>
                      <input type="text"
                             id="slug"
                             class="form-control"
                             name="slug"
                             value="{{ old('slug') }}" />
                    </div>
                  </div>

                  {{-- Description (CKEditor 5) --}}
                  <div class="col-12">
                    <div class="form-group mb-2">
                      <label>Description</label>
                      <textarea id="editor"
                                name="description"
                                class="form-control"
                                rows="10">{!! old('description') !!}</textarea>
                    </div>
                  </div>

                  <!-- Breadcrumb Image picker (unchanged) -->
                  <div class="col-12">
                    <div class="border rounded p-2 breadcrumb-uploader">
                      <h4 class="mb-1">Breadcrumb Image</h4>

                      <label for="breadcrumbInput" class="pick placeholder" id="bcPick" role="button" aria-label="Choose breadcrumb image">
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

                  <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                      <label for="blog-edit-status">Status</label>
                      {!! Form::select('pagestatus', Config::get('constants.pagestatus'), null, [
                          'class' => 'form-control',
                          'placeholder' => 'Select One...',
                          'required'
                      ]) !!}
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
/* Slug auto-fill (unchanged) */
function fillslug(val) {
  var str = (val || '').toString().trim().replace(/\s+/g, '-').toLowerCase();
  var slugEl = document.getElementById("slug");
  if (slugEl) slugEl.value = str;
}

(function(){
  /* ===== Breadcrumb picker (same as before) ===== */
  const fileInput = document.getElementById('breadcrumbInput');
  const pick      = document.getElementById('bcPick');
  const changeBtn = document.getElementById('bcChangeBtn');
  const clearBtn  = document.getElementById('bcClearBtn');
  const resetBtn  = document.getElementById('formResetBtn'); // may be null
  let lastURL = null;

  function openDialog() {
    if (fileInput) fileInput.value = '';
    fileInput && fileInput.click();
  }

  function setPreviewFromFile(file){
    if (!file) return;
    if (lastURL) URL.revokeObjectURL(lastURL);
    const url = URL.createObjectURL(file);
    lastURL = url;
    pick.style.backgroundImage = "url('" + url + "')";
    pick.classList.remove('placeholder');
  }

  function onFilePicked(e){
    const f = e.target && e.target.files && e.target.files[0];
    setPreviewFromFile(f);
  }

  pick && pick.addEventListener('click', function(ev){
    ev.preventDefault();
    openDialog();
  });
  changeBtn && changeBtn.addEventListener('click', function(ev){
    ev.preventDefault();
    openDialog();
  });

  clearBtn && clearBtn.addEventListener('click', function(ev){
    ev.preventDefault();
    if (fileInput) fileInput.value = '';
    if (lastURL) { URL.revokeObjectURL(lastURL); lastURL = null; }
    pick.style.backgroundImage = '';
    pick.classList.add('placeholder');
  });

  resetBtn && resetBtn.addEventListener('click', function(){
    setTimeout(function(){
      if (fileInput) fileInput.value = '';
      if (lastURL) { URL.revokeObjectURL(lastURL); lastURL = null; }
      pick.style.backgroundImage = '';
      pick.classList.add('placeholder');
    }, 0);
  });

  fileInput && fileInput.addEventListener('change', onFilePicked);
  fileInput && fileInput.addEventListener('input',  onFilePicked);

  // hydrate feather icons
  document.addEventListener('DOMContentLoaded', function(){
    if (window.feather) feather.replace();
  });

  /* ===== CKEditor 5 init ===== */
  console.log('[CKEditor] init script running');
  const textarea = document.querySelector('#editor');
  console.log('[CKEditor] textarea found?', !!textarea, textarea);

  if (!textarea) {
    console.error('[CKEditor] #editor textarea not found in DOM');
    return;
  }

  if (typeof ClassicEditor === 'undefined') {
    console.error('[CKEditor] ClassicEditor is undefined. Check script load.');
    return;
  }

  ClassicEditor
    .create(textarea, {
      licenseKey: 'GPL', // 👈 important line for free/GPL usage
      ckfinder: {
        uploadUrl: '{{ route('ckeditor.upload').'?_token='.csrf_token() }}'
      }
    })
    .then(editor => {
      window.ckEditorInstance = editor;
      console.log('[CKEditor] editor created');
    })
    .catch(error => {
      console.error('[CKEditor] init error:', error);
    });

  // Ensure textarea is synced before submit
  const form = document.querySelector('form.mt-2');
  if (form) {
    form.addEventListener('submit', function () {
      if (window.ckEditorInstance &&
          typeof window.ckEditorInstance.updateSourceElement === 'function') {
        window.ckEditorInstance.updateSourceElement();
      }
    });
  }
})();
</script>

@endsection
