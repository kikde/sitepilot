@extends('layouts.app')

@section('content')
<style>
    .breadcrumb-media, .signature-media {
  display: flex;
  flex-direction: column;
}
@media (min-width: 768px) {
  .breadcrumb-media, .signature-media {
    flex-direction: row;
    align-items: center;
  }
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
                            <li class="breadcrumb-item"><a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Create new page</a>
                            </li>
                            
                            
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
                            <h4 class="card-title">Add New</h4>
                        </div>
                        <div class="card-body">
                          
                            <!-- Form -->
                            <form  class="mt-2" action="{{url('/addnew')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-title">Name</label>
                                            <input type="text" id="blog-edit-title" class="form-control" name="name" onchange="fillslug(this.value)" placeholder="" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Slug</label>
                                            <input type="text" id="slug" class="form-control" name="slug"   />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-fund">Raised Fund</label>
                                            <input type="number" id="raised_fund" class="form-control" name="raised_fund"   />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Page Title</label>
                                            <input type="text" id="blog-edit-slug" class="form-control" name="pagetitle" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-slug">Page Keyword</label>
                                            <input type="text" id="blog-edit-slug" class="form-control" name="pagekeyword" value="" placeholder="" />
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-type">Page Type</label>
                                            <!-- <input type="text" id="blog-edit-type" class="form-control" name="types"  placeholder="" /> -->
                                              {!! Form::select('types', Config::get('constants.types'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}

                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label>Description</label>
                                            <div id="blog-editor-wrapper">
                                               
                                                    
                                                    <input type="hidden"  class="form-control" name="description" id="description" />

                                                    <div id="blog-editor-container">
                    
                                                        <div class="editor" > 
 
                                                       </div>
                                                      
                                                      </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                     
                                    <div class="col-12">
                                        <div class="border rounded p-2">
    <h4 class="mb-1">Breadcrumb Image</h4>
    <div class="media flex-column flex-md-row breadcrumb-media">
      <img src="{{ asset('frontend/custom/breadcrump.png') }}" 
           id="breadcrumb-preview" 
           class="rounded mr-2 mb-1 mb-md-0" 
           width="170" height="110" 
           alt="Breadcrumb Image" />

      <div class="media-body">
        <p class="my-50">
          <a href="javascript:void(0);" id="breadcrumb-image-text">
            Required image resolution 1920x442, image size 10 MB.
          </a>
        </p>
        <div class="d-inline-block">
          <div class="form-group mb-0">
            <div class="custom-file">
              <input type="file" 
                     name="breadcrumb" 
                     class="custom-file-input" 
                     id="breadcrumbFile" 
                     accept="image/*" />
              <label class="custom-file-label" for="breadcrumbFile">Choose file</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
                                     </div>


                                  <div class="col-12 mb-2">
  <div class="border rounded p-2">
    <h4 class="mb-1">Other Image</h4>
    <div class="media flex-column flex-md-row signature-media">
      <img src="{{ asset('frontend/custom/breadcrump.png') }}"
           id="signature-preview" 
           class="rounded mr-2 mb-1 mb-md-0" 
           width="170" height="110" 
           alt="Director Signature" />

      <div class="media-body">
        <p class="my-50">
          <a href="javascript:void(0);" id="signature-image-text">
            Required image resolution 300x150, image size 2 MB.
          </a>
        </p>
        <div class="d-inline-block">
          <div class="form-group mb-0">
            <div class="custom-file">
              <input type="file" 
                     name="image" 
                     class="custom-file-input" 
                     id="signatureFile" 
                     accept="image/*" />
              <label class="custom-file-label" for="signatureFile">Choose file</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

                                    

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-status">Status</label>
                                            {!! Form::select('pagestatus', Config::get('constants.pagestatus'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div>

                                    <div class="col-12 mt-50">
                                        <button type="submit"  id="btn-submit" class="btn btn-primary mr-1">Save Changes</button>
                                        <a href="{{ url('/pageList') }}" class="btn btn-outline-secondary mt-0">Go Back</a>
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
  // Grab the actual form
  const form = document.querySelector('form.mt-2');

  form.addEventListener('submit', function () {
    // If you're using a simple contenteditable div with class "editor"
    const editor = document.querySelector('#blog-editor-container .editor');
    let html = '';

    // If using Quill, prefer the .ql-editor
    const quillBody = document.querySelector('.ql-editor');
    if (quillBody) {
      html = quillBody.innerHTML;
    } else if (editor) {
      html = editor.innerHTML;
    }

    document.getElementById('description').value = html; 
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Breadcrumb preview
  const breadcrumbFile = document.getElementById('breadcrumbFile');
  const breadcrumbPreview = document.getElementById('breadcrumb-preview');
  breadcrumbFile.addEventListener('change', e => {
    const file = e.target.files[0];
    if (file) {
      breadcrumbPreview.src = URL.createObjectURL(file);
    }
  });

  // Signature preview
  const signatureFile = document.getElementById('signatureFile');
  const signaturePreview = document.getElementById('signature-preview');
  signatureFile.addEventListener('change', e => {
    const file = e.target.files[0];
    if (file) {
      signaturePreview.src = URL.createObjectURL(file);
    }
  });
});
</script>



@endsection
