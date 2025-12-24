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
  aspect-ratio: 16/9;           /* nice banner shape */
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

/* default placeholder pattern */
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
              <li class="breadcrumb-item"><a href="#">Objective</a></li>
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
              <h4 class="card-title">Add New Objective</h4>
            </div>

            <div class="card-body">
              <!-- Form -->
              <form class="mt-2" action="{{url('/pages')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                      <label for="blog-edit-title">Objective Title </label>
                      <input type="text" id="blog-edit-title" class="form-control" name="sector_name"
                             onchange="fillslug(this.value)" placeholder="" value="" required/>
                    </div>
                  </div>

                  {{-- =========================
                       HIDDEN (COMMENTED): Slug
                       =========================--}}
                  <div class="col-md-6 col-12" hidden>
                    <div class="form-group mb-2">
                      <label for="blog-edit-slug">Slug</label>
                      <input type="text" id="slug" class="form-control" name="slug"  />
                    </div>
                  </div>
                  

                  {{-- =========================
                       HIDDEN (COMMENTED): Page Title
                       =========================
                  <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                      <label for="blog-edit-slug">Page Title</label>
                      <input type="text" id="blog-edit-slug" class="form-control" name="pagetitle" value="" placeholder="" />
                    </div>
                  </div>
                  --}}

                  {{-- =========================
                       HIDDEN (COMMENTED): Page Keyword
                       =========================
                  <div class="col-md-6 col-12">
                    <div class="form-group mb-2">
                      <label for="blog-edit-slug">Page Keyword</label>
                      <input type="text" id="blog-edit-slug" class="form-control" name="pagekeyword" value="" placeholder="" />
                    </div>
                  </div>
                  --}}

                  <div class="col-12">
                    <div class="form-group mb-2">
                      <label>Description</label>
                      <p class="my-50">
                        <a href="javascript:void(0);" id="blog-image-text">Recommended inline image 700×442, max ~10 MB.</a>
                      </p>
                      <div id="blog-editor-wrapper">
                        <input type="hidden" class="form-control" name="description" id="description" />
                        <div id="blog-editor-container">
                          <div class="editor"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- =======================
                     Beautiful Breadcrumb Image Picker
                     ======================= --}}
                <div class="col-12">
                  <div class="border rounded p-2 breadcrumb-uploader">
                    <h4 class="mb-1">Breadcrumb Image</h4>

                    <label for="breadcrumbInput" class="pick placeholder" id="bcPick" role="button" aria-label="Choose breadcrumb image">
                      <div class="overlay"><span><i data-feather="image"></i> Choose Image</span></div>
                    </label>
                    <input type="file" name="breadcrumb" id="breadcrumbInput" class="d-none" accept="image/*" required>

                    <div class="actions">
                      <button type="button" class="btn btn-sm btn-outline-primary" id="bcChangeBtn">
                        <i data-feather="refresh-ccw"></i> Change
                      </button>
                      <button type="button" class="btn btn-sm btn-outline-secondary" id="bcClearBtn">
                        <i data-feather="x"></i> Clear
                      </button>
                    </div>

                    <div class="hint">Ideal size: 700x300 (PNG/JPG). Keep file size reasonable for faster loads.</div>
                  </div>
                </div>
                {{-- ======================= /picker ======================= --}}

                <div class="col-md-6 col-12 mt-2">
                  <div class="form-group mb-2">
                    <label for="blog-edit-status">Status</label>
                    {!! Form::select('pagestatus', Config::get('constants.pagestatus'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                  </div>
                </div>

                <div class="col-12 mt-50">
                  <button type="submit" id="btn-submit" class="btn btn-primary mr-1">Save Changes</button>
                    <a href="{{ url('/pages') }}" class="btn btn-outline-secondary mt-0">Go Back</a>
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
  // safe slug helper (even if slug input is commented out)
  function fillslug(val) {
    var str = (val || '').toString().trim().replace(/\s+/g, '-').toLowerCase();
    var slugEl = document.getElementById("slug");
    if (slugEl) slugEl.value = str;
  }

  // Put editor HTML into hidden input on submit
  (function(){
    const form = document.querySelector('form.mt-2');
    form?.addEventListener('submit', function () {
      const quillBody = document.querySelector('.ql-editor');
      const editor = document.querySelector('#blog-editor-container .editor');
      const html = quillBody ? quillBody.innerHTML : (editor ? editor.innerHTML : '');
      document.getElementById('description').value = html;
    });
  })();

  // Breadcrumb picker (click-to-upload + live preview; robust for Safari/same-file)
  (function(){
    const fileInput = document.getElementById('breadcrumbInput');
    const pick      = document.getElementById('bcPick');
    const changeBtn = document.getElementById('bcChangeBtn');
    const clearBtn  = document.getElementById('bcClearBtn');
    const resetBtn  = document.getElementById('formResetBtn');
    let lastURL = null;

    function openDialog(){
      if (fileInput) fileInput.value = ''; // ensure same file triggers change
      fileInput?.click();
    }
    function setPreview(url){
      if (!url){ pick.style.backgroundImage=''; pick.classList.add('placeholder'); return; }
      pick.style.backgroundImage = `url('${url}')`;
      pick.classList.remove('placeholder');
    }
    function fromFile(file){
      if (!file) return;
      if (lastURL) URL.revokeObjectURL(lastURL);
      lastURL = URL.createObjectURL(file);
      setPreview(lastURL);
    }
    function onPicked(e){ fromFile(e.target?.files?.[0]); }

    pick?.addEventListener('click', (ev)=>{ ev.preventDefault(); openDialog(); });
    changeBtn?.addEventListener('click', (ev)=>{ ev.preventDefault(); openDialog(); });
    clearBtn?.addEventListener('click', (ev)=>{ ev.preventDefault(); fileInput.value=''; if (lastURL){URL.revokeObjectURL(lastURL); lastURL=null;} setPreview(''); });
    resetBtn?.addEventListener('click', ()=>{ setTimeout(()=>{ fileInput.value=''; if (lastURL){URL.revokeObjectURL(lastURL); lastURL=null;} setPreview(''); },0); });

    fileInput?.addEventListener('change', onPicked);
    fileInput?.addEventListener('input',  onPicked);

    // hydrate feather icons
    document.addEventListener('DOMContentLoaded', function(){
      if (window.feather) feather.replace();
    });
  })();
</script>
@endsection
