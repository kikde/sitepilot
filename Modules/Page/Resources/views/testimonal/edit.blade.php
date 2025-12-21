@extends('layouts.app')

@section('content')
<style>
/* ===== Fancy, mobile-friendly image picker (Testimonial photo) ===== */
.tm-uploader{
  border: 2px dashed #e5e7eb;
  border-radius: 14px;
  background:#fafafa;
  padding: 12px;
}
.tm-uploader .pick{
  position: relative;
  width: 180px;
  aspect-ratio: 1/1;               /* square avatar */
  border-radius: 50%;               /* circle preview */
  overflow: hidden;
  background:#f3f4f6 center/cover no-repeat;
  cursor: pointer;
  display: grid;
  place-items: center;
  margin-left: .5rem;
}
.tm-uploader .pick .overlay{
  position:absolute; inset:0;
  display:flex; align-items:center; justify-content:center;
  background: linear-gradient(to top, rgba(0,0,0,.38), rgba(0,0,0,.12));
  color:#fff; font-weight:600;
  opacity:0; transition:.2s ease;
  text-align:center;
}
.tm-uploader .pick:hover .overlay{ opacity:1; }
.tm-uploader .pick .overlay span{
  display:inline-flex; align-items:center; gap:.4rem;
  background: rgba(17,24,39,.6);
  padding:.45rem .65rem; border-radius:999px;
  backdrop-filter: blur(2px);
  line-height:1;
}
.tm-uploader .hint{
  font-size:.84rem; color:#6b7280; margin-top:.5rem;
}
.tm-uploader .actions{
  margin-top:.5rem; display:flex; gap:.5rem; flex-wrap:wrap; align-items:center;
}
.tm-uploader .actions .btn-sm{ border-radius:10px; }
@media (max-width: 576px){
  .tm-uploader .pick{ width: 140px; }
}
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Testimonials</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Edit Testimonials</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Testimonials</h4></div>

            <div class="card-body">
              <form class="form" action="{{ url('/testimonials/'.$test->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input id="id" type="text" class="form-control" name="id" value="{{$test->id}}" hidden>

                <div class="row">
                  {{-- ===================== Fancy Image Upload (with existing preview) ===================== --}}
                  <div class="col-12">
                    @php
                      $existingImg = $test->images
                        ? asset('backend/testimonial/'.$test->images)
                        : asset('frontend/custom/user.png');
                    @endphp
                    <div class="form-group row align-items-start">
                      <div class="col-sm-3 col-form-label">
                        <label>Upload</label>
                      </div>
                      <div class="col-sm-9">
                        <div class="tm-uploader">
                          <label for="account-upload" class="pick" id="tmPick" role="button" aria-label="Choose testimonial image"
                                 style="background-image:url('{{ $existingImg }}')">
                            <div class="overlay"><span><i data-feather="image"></i> Change</span></div>
                          </label>
                          <input type="file" id="account-upload" class="d-none" name="images" accept="image/*" />

                          <div class="actions">
                            <button type="button" class="btn btn-sm btn-outline-primary" id="tmChangeBtn">
                              <i data-feather="refresh-ccw"></i> Change
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="tmClearBtn">
                              <i data-feather="x"></i> Clear
                            </button>
                          </div>
                          <div class="hint">Square image works best (e.g. 600×600). JPG/PNG/GIF.</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- ========================= HIDDEN (COMMENTED): Image Alt Tag ========================= --}}
                  {{--
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label for="alt_tag">Image Alt Tag</label></div>
                      <div class="col-sm-9"><input type="text" id="alt_tag" class="form-control" name="alt_tag" value="{{$test->alt_tag}}" /></div>
                    </div>
                  </div>
                  --}}
                  

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label for="name">Name</label></div>
                      <div class="col-sm-9"><input type="text" id="name" class="form-control" name="name" value="{{$test->name}}" placeholder=""  required/></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label for="desg">Designation</label></div>
                      <div class="col-sm-9"><input type="text" id="desg" class="form-control" name="desg" value="{{$test->desg}}" placeholder="" /></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label for="description">Review</label></div>
                      <div class="col-sm-9"><textarea name="description" id="description" class="form-control" rows="10">{{$test->description}}</textarea></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label for="rating">Rating</label></div>
                      <div class="col-sm-9"><input type="text" id="rating" class="form-control" name="rating" value="{{$test->rating}}" placeholder="" /></div>
                    </div>
                  </div>

                  {{-- ========================= HIDDEN (COMMENTED): Page Title ========================= --}}
                  {{--
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label for="page_title">Page Title</label></div>
                      <div class="col-sm-9"><input type="text" id="page_title" class="form-control" name="page_title" value="{{$test->page_title}}" /></div>
                    </div>
                  </div>
                  --}}
                  

                  {{-- ========================= HIDDEN (COMMENTED): Page Keywords ========================= --}}
                  {{--
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label for="page_keywords">Page Keywords</label></div>
                      <div class="col-sm-9"><input type="text" id="page_keywords" class="form-control" name="page_keywords" value="{{$test->page_keywords}}" /></div>
                    </div>
                  </div>
                  --}}
                

                  <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Go Back</button>
                  </div>
                </div>
                
              </form>
            </div><!--/card-body-->
          </div>
        </div>
      </div>
    </section>
    <!-- Basic Horizontal form layout section end -->
  </div>
</div>

<script>
(function(){
  // Fancy avatar picker with live preview (works even if same file re-selected; Safari friendly)
  const fileInput = document.getElementById('account-upload');
  const pick      = document.getElementById('tmPick');
  const changeBtn = document.getElementById('tmChangeBtn');
  const clearBtn  = document.getElementById('tmClearBtn');
  const existing  = @json($existingImg ?? '');
  let lastURL = null;

  function setPreview(url){
    if (!url){
      // fall back to existing if we had one
      if (existing){ pick.style.backgroundImage = `url('${existing}')`; }
      else { pick.style.backgroundImage = ''; pick.classList.add('placeholder'); }
      return;
    }
    pick.style.backgroundImage = `url('${url}')`;
    pick.classList.remove('placeholder');
  }

  function openDialog(){
    if (fileInput) fileInput.value = ''; // ensure same-file change fires
    fileInput?.click();
  }

  function fromFile(file){
    if (!file) return;
    if (lastURL) URL.revokeObjectURL(lastURL);
    const url = URL.createObjectURL(file);
    lastURL = url;
    setPreview(url);
  }

  function onPicked(e){ fromFile(e.target?.files?.[0]); }

  pick?.addEventListener('click',  (ev)=>{ ev.preventDefault(); openDialog(); });
  changeBtn?.addEventListener('click', (ev)=>{ ev.preventDefault(); openDialog(); });

  clearBtn?.addEventListener('click', (ev)=>{
    ev.preventDefault();
    fileInput.value = '';
    if (lastURL){ URL.revokeObjectURL(lastURL); lastURL = null; }
    // show original (if any) or empty placeholder
    setPreview('');
  });

  fileInput?.addEventListener('change', onPicked);
  fileInput?.addEventListener('input',  onPicked);

  // hydrate feather icons
  document.addEventListener('DOMContentLoaded', function(){
    if (window.feather) feather.replace();
  });
})();
</script>
@endsection
