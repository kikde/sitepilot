@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Add Template </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Add</a>
                                </li>
                               
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
                            <div class="card-header">
                                <h4 class="card-title">Add New</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('email-templates.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="identifier" value="">
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="email-id">{{translate('Activation')}}</label>
                                            </div>
                                            <div class="custom-control custom-control-primary custom-switch">
                                               
                                                <input type="checkbox" checked="" value="1"  name="status" class="custom-control-input" id="customSwitch3">
                                                <label class="custom-control-label" for="customSwitch3"></label>
                                            </div>
                                            {{-- <div class="col-md-10">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input value="1" name="status" type="checkbox"
                                                        checked
                                                    >
                                                    <span class="slider round"></span>
                                                </label>
                                            </div> --}}
                                        </div>
                                       </div>
                                       <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">{{translate('Identifier')}}</label>
                                            <div class="col-md-10">
                                                <input type="text" name="identifier" value="" class="form-control" placeholder="account_opening_email_to_admin" required>
                                             
                                            </div>
                                        </div>
                                       </div>
                                       <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">{{translate('Subject')}}</label>
                                            <div class="col-md-10">
                                                <input type="text" name="subject" value="" class="form-control" placeholder="{{translate('Subject')}}" required>
                                                @error('subject')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                       </div>
                                        <div class="col-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">{{translate('Email Body')}}</label>
                                            <div class="col-md-10">
                                                <div id="blog-editor-wrapper">
                                                
                                                        
                                                    <input type="hidden"  class="form-control" name="body" id="body"  />

                                                    <div id="blog-editor-container">
                    
                                                        <div class="editor" > 
                                                            
                                                    </div>
                                                    
                                                    </div>

                                                </div>
                                                <small class="form-text text-danger">{{ ('**N.B : Do Not Change The Variables Like [[ ____ ]].**') }}</small>
                                                @error('body')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                                {{-- <textarea name="body" class="form-control aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="300" required>{{ $email_template->body }}</textarea> --}}
                                                
                                            </div>
                                        </div>
                                        </div>
                                        {{-- <div class="form-group mb-3 text-right">
                                            <button type="submit" id="btn-submit" class="btn btn-primary">{{translate('Save Changes')}}</button>
                                        </div> --}}

                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" id="btn-submit" class="btn btn-primary mr-0">{{translate('Save Changes')}}</button>
                                            <a  hrefclass="btn btn-outline-secondary">Go Back</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </section>
            <!-- Basic Horizontal form layout section end -->           

        </div>
    </div>
</div>

<script>
    $('#btn-submit').on('click', () => { 
    var myEditor = document.querySelector('.editor');

    console.log(myEditor);
    // Get HTML content
    var html = myEditor.children[0].innerHTML;

    // alert(html);
    // Copy HTML content in hidden form
   $('#body').val( html )

    console.log(html);

    // Post form
    myForm.submit();

})
</script>
@endsection
