@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Banner</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Add Banner</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="card">
            <div class="card-header"><h4 class="card-title">Add New</h4></div>

            <div class="card-body">
              <form class="form" action="{{ url('/home/add-banner') }}" method="post"
                    enctype="multipart/form-data" id="bannerAddForm">
                @csrf

                <div class="row">
                  <div class="col-12">
                    <div class="form-group row align-items-center"> 
                      <div class="col-sm-3 col-form-label">
                        <label for="account-upload" class="mb-0">Upload <span class="text-danger">*</span></label>
                      </div>

                      <div class="col-sm-9 d-flex align-items-start gap-2">
                        {{-- preview --}}
                        <a href="javascript:void(0);" class="mr-25">
                          <img src="{{ asset('frontend/custom/breadcrump.png') }}"
                               id="account-upload-img" class="rounded mr-50"
                               alt="preview" height="150" width="150" />
                        </a>

                        {{-- upload + reset --}}
                        <div class="media-body mt-0 ml-1">
                          <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                          <input type="file" id="account-upload" class="custom-file-input"
                                 name="images" accept="image/*" required />
                          <button type="button" class="btn btn-sm btn-outline-secondary mb-75" id="resetUpload">Reset</button>
                          <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 800kB</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- =========================
                       SEO / Meta fields hidden
                       ========================= --}}

                  {{--
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label>Image Alt Tag</label></div>
                      <div class="col-sm-9"><input type="text" class="form-control" name="alt_tag"></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label>Title</label></div>
                      <div class="col-sm-9"><input type="text" class="form-control" name="title"></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label>Meta Title</label></div>
                      <div class="col-sm-9"><input type="text" class="form-control" name="meta_title"></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label>Meta Tag</label></div>
                      <div class="col-sm-9"><input type="text" class="form-control" name="meta_tag"></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label>Meta Keywords</label></div>
                      <div class="col-sm-9"><input type="text" class="form-control" name="meta_keywords"></div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label"><label>Meta Description</label></div>
                      <div class="col-sm-9"><input type="text" class="form-control" name="meta_description"></div>
                    </div>
                  </div>
                  --}}

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-sm-3 col-form-label">
                        <label for="messages">Status</label>
                      </div>
                      <div class="col-sm-9">
                        {!! Form::select('status', Config::get('constants.pagestatus'), null, ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                    <a href="{{ url('/home/banner-list') }}" class="btn btn-outline-secondary">Go Back</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>

{{-- simple client-side validation & live preview --}}
<script>
(function(){
  const fileInput = document.getElementById('account-upload');
  const preview   = document.getElementById('account-upload-img');
  const resetBtn  = document.getElementById('resetUpload');
  const form      = document.getElementById('bannerAddForm');

  // preview selected image
  fileInput?.addEventListener('change', (e)=>{
    const f = e.target.files?.[0];
    if(!f) return;
    const url = URL.createObjectURL(f);
    preview.src = url;
  });

  // reset file + preview
  resetBtn?.addEventListener('click', ()=>{
    fileInput.value = '';
    preview.src = "{{ asset('frontend/custom/breadcrump.png') }}";
  });

  // ensure image is chosen before submit
  form?.addEventListener('submit', (e)=>{
    if(!fileInput?.files?.length){
      e.preventDefault();
      alert('Please upload an image before submitting.');
      fileInput?.focus();
    }
  });
})();
</script>
@endsection
