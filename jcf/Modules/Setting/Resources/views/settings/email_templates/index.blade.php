@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Email Templates</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Pages</a>
                            </li>
                            <li class="breadcrumb-item active">Email Template
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <a href="{{url('/email-templates/create')}}" class="btn-icon btn btn-primary btn-round btn-sm" type="button" ><i data-feather="plus"></i>Add New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
          <!-- account setting page -->
          <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column nav-left">
                        <!-- general -->
                        <li class="nav-item">
                            @foreach ($email_templates as $key => $email_template)
                            <a class="nav-link @if($email_template->id == 1) active @endif" id="{{$email_template->id}}" data-toggle="pill" href="#account-vertical-general-{{ $email_template->id }}" aria-expanded="true" onClick="reply_click(this.id)">
                                <i data-feather="user" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">{{ translate(ucwords(str_replace('_', ' ', $email_template->identifier)))  }}</span>
                            </a>
                            @endforeach
                        </li>

                    </ul>
                </div>
                <!--/ left menu section -->

                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- general tab -->
                                @foreach ($email_templates as $key => $email_template)
                                <div role="tabpanel" class="tab-pane @if($email_template->id == 1) active @endif" id="account-vertical-general-{{ $email_template->id }}" aria-labelledby="account-pill-general" aria-expanded="true">

                                    <form action="{{ route('email-templates.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="identifier" value="{{ $email_template->identifier }}">
                                        @if($email_template->identifier != 'password_reset_email')
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <label class="col-from-label">{{translate('Activation')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input value="1" name="status" type="checkbox" @if ($email_template->status == 1)
                                                            checked
                                                        @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">{{translate('Subject')}}</label>
                                            <div class="col-md-10">
                                                <input type="text" name="subject" value="{{ $email_template->subject }}" class="form-control" placeholder="{{translate('Subject')}}" required>
                                                @error('subject')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">{{translate('Email Body')}}</label>
                                            <div class="col-md-10">
                                                <div id="blog-editor-wrapper">
                                                
                                                        
                                                    <input type="hidden"  class="form-control" name="body" id="body"   />

                                                    {{-- <div id="blog-editor-container"> --}}
                    
                                                        <div id="editor-{{$email_template->id}}" value="1"> 
                                                            {!!$email_template->body!!}
                                                    </div>
                                                    
                                                    {{-- </div> --}}

                                                </div>
                                                <small class="form-text text-danger">{{ ('**N.B : Do Not Change The Variables Like [[ ____ ]].**') }}</small>
                                                @error('body')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 text-right">
                                            <button type="submit" id="btn-submit" class="btn btn-primary">{{translate('Update Settings')}}</button>
                                        </div>
                                    </form>
                                </div>
                                <!--/ general tab -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ right content section -->
            </div>
        </section>
        <!-- / account setting page -->
       
         
   


    </div>
</div>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>

function reply_click(clicked_id)
  {
     
    if(value)
    var edit='#editor-'+clicked_id;
       var quill = new Quill(edit, {
       theme: 'snow'
  });
      
  }




</script>
@endsection