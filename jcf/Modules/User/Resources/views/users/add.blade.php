@extends('layouts.app')

@section('content')

<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Add Details</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Add-new</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <!-- account setting page -->
    <section id="page-account-settings">
      <div class="row justify-content-center"><!-- center the only column -->

        <div class="col-12 col-lg-9"><!-- full on mobile, 75% on lg+ -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Add New User</h4>
            </div>

            <div class="card-body">
              <form action="{{url('/users-add')}}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                @csrf

                <!-- header media -->
                <div class="media">
                  <img src="{{asset('backend/uploads/user.jpg')}}"
                       id="account-upload-img"
                       class="rounded mr-50"
                       alt="profile image"
                       height="80" width="80" />

                  <!-- upload and reset button -->
                  <div class="media-body mt-75 ml-1">
                    <label for="account-upload" class="btn btn-sm btn-danger mb-75 mr-75">Upload</label>
                    <input type="file" id="account-upload" hidden accept="image/*"
                           name="profile_image" class="@error('profile_image') is-invalid @enderror" />
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-75" id="uploadReset">Reset</button>
                    <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                    @error('profile_image')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <!--/ upload and reset button -->
                </div>
                <!--/ header media -->

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="referrer-id">Added By (Referrer)</label>

                      @if($currentUser->role == 1)
                        <select id="referrer-id" class="form-control" name="referrer_id">
                          <option value="">— None —</option>
                          @foreach($possibleReferrers as $u)
                            <option value="{{ $u->id }}" {{ old('referrer_id') == $u->id ? 'selected' : '' }}>
                              {{ $u->id }} — {{ $u->name }} ({{ $u->email }})
                            </option>
                          @endforeach
                        </select>
                      @else
                        <input type="hidden" name="referrer_id" value="{{ $currentUser->id }}">
                        <input type="text" class="form-control" value="{{ $currentUser->id }} — {{ $currentUser->name }} ({{ $currentUser->email }})" readonly>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="first-name-column"> Name</label>
                      <input type="text" id="first-name-column" class="form-control" placeholder="Name" name="name" required/>
                      <div class="valid-tooltip">Looks good!</div>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="last-name-column">Email</label>
                      <input type="email" id="last-name-column" class="form-control" placeholder="Email" name="email" required/>
                      <div class="valid-tooltip">Looks good!</div>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="mob-column">Mobile</label>
                      <input type="number" id="mob-column" class="form-control" placeholder="Mobile" name="mobile" maxlength="10" required />
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="account-new-password">Password</label>
                      <div class="input-group form-password-toggle input-group-merge">
                        <input type="password" id="account-new-password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="New Password" value="" required/>
                        <div class="input-group-append">
                          <div class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="company-column">S/O,W/O,Mrs./Mr</label>
                      <input type="text" id="company-column" class="form-control" name="fname" placeholder="S/O,W/O,Mrs./Mr" required/>
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label for="date-id-column">DOB</label>
                      <input type="date" id="date-id-column" class="form-control" name="dob" placeholder="Dob" required/>
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label for="g-id-column">Gender</label>
                      {!! Form::select('gender', Config::get('constants.gender'), null, ['class'=>"form-control",'value' => 'female', 'required']) !!}
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="edu-id-column">Education</label>
                      <input type="text" id="edu-id-column" class="form-control" name="education" placeholder="Qualification" required/>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="email-id-column">Occupation</label>
                      {!! Form::select('occupation', Config::get('constants.profession'), null, ['class'=>"form-control",'value' => 'student', 'required']) !!}
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="address-id-column">Address</label>
                      <input type="text" id="address-column" class="form-control" placeholder="Address" name="address" required/>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="station-id-column">City</label>
                      <input type="text" id="station-column" class="form-control" placeholder="City" name="landmark" required/>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="pin-id-column">Pincode</label>
                      <input type="text" id="pin-column" class="form-control" placeholder="Pincode" name="pincode" required/>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="state">State</label>
                      <select class="form-control" name="state" id="state" required>
                        <option value="0">Select State</option>
                        @foreach($getlist as $key=>$value)
                          <option value="{{$key}}">{{$key}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="dist-id-column">City</label>
                      <select class="form-control" id="city" name="city" required>
                        <option value="0">Select City</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6 col-12">
                    <div class="form-group">
                      <label for="des-id-column">Designation</label>
                      {!! Form::select('desg',Config::get('constants.desg'),null, ['class'=>"form-control",'placeholder' => 'Select One...', 'required']) !!}
                    </div>
                  </div>

                  <div class="col-sm-6 col-12">
                    <div class="form-group">
                      <label for="des-id-column">Blood Group</label>
                      {!! Form::select('bloodgroup',Config::get('constants.bloodgroup'),null, ['class'=>"form-control",'placeholder' => 'Select One...', 'required']) !!}
                    </div>
                  </div>

                  <div class="col-sm-6 col-12">
                    <div class="form-group">
                      <label for="des-id-column">Wings</label>
                      {!! Form::select('bpscell',Config::get('constants.bpscell'),null, ['class'=>"form-control",'placeholder' => 'Select Cell...', 'required']) !!}
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label for="type-id-column" class="font-weight-bolder">ID Proof</label>
                      {!! Form::select('idtype', Config::get('constants.idtype'), null, ['class'=>"form-control", 'placeholder' => 'Select Id Proof...', 'required']) !!}
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label for="idn-id-column">Identity No</label>
                      <input type="text" id="idn-id-column" class="form-control" placeholder="00000" name="id_no" required/>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="upload-id-column">Upload Document</label>
                      <input type="file" id="upload-id-column" class="form-control" name="idproof_doc" required/>
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label for="add-id-column" class="font-weight-bolder">Address Proof</label>
                      {!! Form::select('addtype', Config::get('constants.addtype'), null, ['class'=>"form-control", 'placeholder' => 'Select Address Proof...', 'required']) !!}
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group">
                      <label for="addr-no-column">Address No</label>
                      <input type="text" id="addr-no-column" class="form-control" placeholder="00000" name="address_no" required/>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="other-doc-upload">Upload Document</label>
                      <input type="file" id="other-doc-upload" class="form-control" name="other_doc" required/>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label class="form-label" for="vertical-status">User Active</label>
                      {!! Form::select('useractive', Config::get('constants.status'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'required']) !!}
                    </div>
                  </div>

                  <input type="text" class="form-control" id="role" name="role" value="2" hidden/>

                  <div class="col-12">
                    <button type="submit" class="btn btn-danger mr-1">Submit</button>
                    <a href="{{ url('/userslist') }}" class="btn btn-outline-secondary mt-0">Go Back</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type='text/javascript'>
  jQuery('#state').change(function(){
    let sid=jQuery(this).val();
    jQuery.ajax({
      url:'/city-list',
      type:'post',
      data:'sid='+sid+'&_token={{csrf_token()}}',
      success:function(result){
        jQuery('#city').html(result)
      }
    });
  });

  // avatar preview + reset (optional, no server changes)
  (function(){
    const input  = document.getElementById('account-upload');
    const img    = document.getElementById('account-upload-img');
    const reset  = document.getElementById('uploadReset');
    const fallback = "{{ asset('backend/uploads/user.jpg') }}";
    let lastURL = null;

    function setPreview(file){
      if (!file) return;
      if (lastURL) URL.revokeObjectURL(lastURL);
      lastURL = URL.createObjectURL(file);
      img.src = lastURL;
    }
    document.querySelector('label[for="account-upload"]')?.addEventListener('click', (e)=>{ e.preventDefault(); input.value=''; input.click(); });
    input?.addEventListener('change', (e)=> setPreview(e.target.files?.[0]));
    input?.addEventListener('input',  (e)=> setPreview(e.target.files?.[0]));
    reset?.addEventListener('click', (e)=>{ e.preventDefault(); input.value=''; if (lastURL){URL.revokeObjectURL(lastURL); lastURL=null;} img.src=fallback; });
  })();
</script>
@endsection
