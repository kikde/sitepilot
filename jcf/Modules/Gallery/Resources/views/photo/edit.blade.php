{{-- resources/views/photogallery/edit.blade.php --}}
@extends('layouts.app')

@section('content')

@php
    // Resolve section (controller → query → existing row → default)
    $section       = $share_site ?? request('share_site') ?? ($gall->share_site ?? 'gallery');
    $sectionLabel  = ucfirst($section);
    $backUrl       = url('/photogallery') . '?share_site=' . $section;
    $isCertificate = in_array(strtolower($section), ['certificate','certificates']);
@endphp

<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
        <div class="mb-1 mb-md-0">
          <h2 class="content-header-title mb-0">{{ $sectionLabel }} Photo</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit {{ $sectionLabel }}</li>
            </ol>
          </div>
        </div>

        <div class="d-flex align-items-center gap-2">
          <a href="{{ $backUrl }}" class="btn btn-outline-secondary btn-round btn-sm">
            <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <section id="basic-horizontal-layouts">
      <div class="row">
        <div class="col-md-7 col-12">
          <div class="card">
            <div class="card-header"><h4 class="card-title">Edit {{ $sectionLabel }}</h4></div>

            <div class="card-body">
              <form class="form form-horizontal"
                    action="{{ url('/photogallery/'.$gall->id) }}"
                    method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- id & type --}}
                <input type="hidden" name="id" value="{{ $gall->id }}">
                <input type="hidden" name="type" value="photo">

                {{-- section --}}
                <input type="hidden" name="share_site" value="{{ $section }}">

                {{-- Upload --}}
                <div class="form-group row align-items-center">
                  <label class="col-sm-3 col-form-label" for="account-upload">Upload</label>

                  <div class="col-sm-9 d-flex align-items-center">
                    <img
                      src="{{ $gall->images ? asset('backend/gallery/photo/'.$gall->images) : asset('frontend/custom/breadcrump.png') }}"
                      id="account-upload-img"
                      class="rounded mr-50"
                      alt="current image"
                      height="100" width="100" />

                    <div class="ml-1">
                      <label for="account-upload" class="btn btn-sm btn-primary mb-0">Change Image</label>
                      <input type="file" id="account-upload" class="custom-file-input d-none"
                             name="images" accept="image/*"> {{-- not required on edit --}}
                      <div class="text-muted small mt-50">JPG / PNG, recommended ≥ 800px</div>
                    </div>
                  </div>
                </div>

                {{-- Title (CERTIFICATE ONLY) --}}
                @if($isCertificate)
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="title">Title</label>
                    <div class="col-sm-9">
                      <input type="text" id="title" class="form-control" name="title"
                             value="{{ old('title', $gall->title) }}"
                             placeholder="Enter certificate title" required>
                    </div>
                  </div>

                  {{-- Description (CERTIFICATE ONLY) --}}
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="description">Description</label>
                    <div class="col-sm-9">
                      <textarea id="description" name="description" class="form-control"
                                rows="3" placeholder="Short description (optional)">{{ old('description', $gall->description ?? '') }}</textarea>
                      <small class="text-muted">A brief summary shown with the certificate.</small>
                    </div>
                  </div>
                @endif

                {{-- Status --}}
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" for="status">Status</label>
                  <div class="col-sm-9">
                    {!! Form::select(
                        'status',
                        Config::get('constants.pagestatus'),
                        old('status', $gall->status),
                        ['class' => 'form-control', 'id' => 'status']
                    ) !!}
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary mr-1">Update</button>
                    <a href="{{ $backUrl }}" class="btn btn-outline-secondary">Go Back</a>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

        {{-- Optional live preview (desktop only) --}}
        @if($isCertificate)
          <div class="col-md-5 d-none d-md-block">
            <div class="card">
              <div class="card-header"><h4 class="card-title mb-0">Preview</h4></div>
              <div class="card-body">
                <div class="border rounded p-1">
                  <img id="preview-img"
                       src="{{ $gall->images ? asset('backend/gallery/photo/'.$gall->images) : asset('frontend/custom/breadcrump.png') }}"
                       class="w-100 mb-75" style="max-height:260px;object-fit:cover;border-radius:.5rem">
                  <h5 id="preview-title" class="mb-50 text-truncate">{{ $gall->title ?: 'Certificate title' }}</h5>
                  <div id="preview-desc" class="text-muted small">
                    {{ $gall->description ?? 'Description will appear here.' }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif

      </div>
    </section>
  </div>
</div>

{{-- Tiny preview for changed file/title/description --}}
<script>
document.addEventListener('DOMContentLoaded', function(){
  const file = document.getElementById('account-upload');
  const img  = document.getElementById('account-upload-img');
  if(file && img){
    file.addEventListener('change', e=>{
      const f = e.target.files && e.target.files[0];
      if(!f) return;
      const url = URL.createObjectURL(f);
      img.src = url;
      const pimg = document.getElementById('preview-img');
      if(pimg) pimg.src = url;
    });
  }
  const title = document.getElementById('title');
  if(title){
    const pt = document.getElementById('preview-title');
    title.addEventListener('input', ()=>{ if(pt){ pt.textContent = title.value || 'Certificate title'; } });
  }
  const desc = document.getElementById('description');
  if(desc){
    const pd = document.getElementById('preview-desc');
    desc.addEventListener('input', ()=>{ if(pd){ pd.textContent = desc.value || 'Description will appear here.'; } });
  }
  if(window.feather) feather.replace();
});
</script>

@endsection
