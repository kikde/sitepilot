@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Members</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Member</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Edit Member</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $member->id }}">

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Name</label>
                      <input type="text" id="name" class="form-control" name="name"
                             value="{{ old('name', $member->name) }}" onchange="fillslug(this.value)">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Gender</label>
                      {!! Form::select('gender', Config::get('constants.gender'),
                          old('gender', $member->gender),
                          ['class'=>"form-control", 'placeholder'=>'Pick a Gender...']) !!}
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>DOB</label>
                      <input type="date" id="dob-column" class="form-control" name="dob"
                             value="{{ old('dob', $member->dob) }}">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Father Name</label>
                      <input type="text" id="father-floating" class="form-control" name="father_name"
                             value="{{ old('father_name', $member->father_name) }}">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Profession</label>
                      {!! Form::select('profession', Config::get('constants.profession'),
                          old('profession', $member->profession),
                          ['class'=>"form-control", 'placeholder'=>'Select...']) !!}
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Blood Group</label>
                      {!! Form::select('bloodgroup', Config::get('constants.bloodgroup'),
                          old('bloodgroup', $member->bloodgroup),
                          ['class'=>"form-control", 'placeholder'=>'Select...']) !!}
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>State</label>
                      <select name="state" id="state" class="form-control">
                        <option value="{{ old('state', $member->state) }}">{{ old('state', $member->state) }}</option>
                        @foreach($states as $key => $value)
                          <option value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>City</label>
                      <select class="custom-select" name="city" id="city">
                        <option value="{{ old('city', $member->city) }}">{{ old('city', $member->city) }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Mobile</label>
                      <input type="tel" class="form-control" name="mobile" maxlength="10"
                             value="{{ old('mobile', $member->mobile) }}" required>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email"
                             value="{{ old('email', $member->email) }}" required>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Address</label>
                      <input class="form-control" id="address" name="address"
                             value="{{ old('address', $member->address) }}" required>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Pincode</label>
                      <input type="number" class="form-control" name="pincode"
                             value="{{ old('pincode', $member->pincode) }}">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Slug</label>
                      <input type="text" id="slug" class="form-control" name="slug"
                             value="{{ old('slug', $member->slug) }}">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Page Title</label>
                      <input type="text" class="form-control" name="page_title"
                             value="{{ old('page_title', $member->page_title) }}">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Page Keyword</label>
                      <input type="text" class="form-control" name="page_keyword"
                             value="{{ old('page_keyword', $member->page_keyword) }}">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Ratings</label>
                      <input type="number" id="rating" class="form-control" name="rating" min="0" max="5"
                             value="{{ old('rating', $member->rating) }}">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Select Id Type</label>
                      {!! Form::select('idtype', Config::get('constants.idtype'),
                          old('idtype', $member->idtype),
                          ['class'=>"form-control", 'placeholder'=>'Select One...']) !!}
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Upload File</label>
                      <input type="file" id="uploadfile" class="form-control" name="uploadfile">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="border rounded p-2">
                      <h4 class="mb-1">Profile Image</h4>
                      <div class="media flex-column flex-md-row">
                        @php
                          $img = $member->images ? asset('backend/uploads/'.$member->images) : asset('frontend/custom/user.png');
                        @endphp
                        <img src="{{ $img }}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Profile Image" />
                        <div class="media-body">
                          <p class="my-50">
                            <a href="javascript:void(0);" id="blog-image-text">Required image resolution 270x280.</a>
                          </p>
                          <div class="d-inline-block">
                            <div class="form-group mb-0">
                              <div class="custom-file">
                                <input type="file" name="images" class="custom-file-input" id="blogCustomFile" accept="image/*">
                                <label class="custom-file-label" for="blogCustomFile">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group row increment">
                      <div class="col-sm-3 col-form-label font-weight-bolder">
                        <label>Other Documents</label>
                      </div>
                      <input type="file" id="account-upload" class="form-control" name="document">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="font-weight-bolder">Status</label>
                      {!! Form::select('status', Config::get('constants.status'),
                          old('status', $member->status),
                          ['class'=>"form-control", 'placeholder'=>'Select One...']) !!}
                    </div>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                  </div>
                </div> {{-- .row --}}
              </form> {{-- ← MISSING BEFORE: close the form --}}
            </div> {{-- .card-body --}}
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script>
function fillslug(val){
  var str = (val || '').toString().trim().replace(/\s+/g,'-').toLowerCase();
  document.getElementById("slug").value = str;
}

jQuery('#state').change(function(){
  let sid=jQuery(this).val();
  jQuery.ajax({
    url:'/city-listby',
    type:'post',
    data:'sid='+sid+'&_token={{ csrf_token() }}',
    success:function(result){ jQuery('#city').html(result) }
  });
});
</script>
@endsection
