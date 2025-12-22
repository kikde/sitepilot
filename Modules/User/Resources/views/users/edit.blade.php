@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit Your Details</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <b>Your Reg.No.</b>
                                <h1 class="badge badge-pill badge-glow badge-danger">{{ $users->regno }}</h1>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <!-- account setting page -->
        <section id="page-account-settings">
            <div class="row">
           
                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">

                            <!-- general tab -->
                            <div class="row">
                                {{-- NEW: Affidavit toggle + file links 
                                <div class="col-6 mb-2">
                                    @php $isActive = !empty($users->before_affidavit); @endphp

                                    <form action="{{ $isActive ? url('/affidavit-deactive/'.$users->id) : url('/affidavit-active/'.$users->id) }}"
                                          method="POST">
                                        @csrf
                                        <div class="custom-control custom-control-primary custom-switch">
                                            <input type="checkbox"
                                                class="custom-control-input"
                                                id="affSwitch{{ $users->id }}"
                                                @checked($isActive)
                                                onchange="this.form.submit()">
                                            <label class="custom-control-label" for="affSwitch{{ $users->id }}">
                                                {{ $isActive ? 'DeActivate Affidavit' : 'Activate Affidavit' }}
                                            </label>
                                        </div>
                                    </form>

                                    @if(!empty($users->before_affidavit))
                                        <div class="mt-1">
                                            <a class="text-success" href="{{ route('doc.view', ['user' => $users->id, 'type' => 'aff_before']) }}" target="_blank">
                                                View Original Affidavit (before signing)
                                            </a>
                                        </div>
                                    @endif--}}

                                    {{-- View link 
                                    @if(!empty($users->after_verifiy_affidavit))
                                      <div class="mt-1">
                                        <a class="text-primary" href="{{ route('doc.view', ['user' => $users->id, 'type' => 'aff_after']) }}" target="_blank">
                                          View Signed Affidavit (uploaded)
                                        </a>
                                      </div>
                                    @endif
                                </div>--}}
                                <!-- Referral Link Card (everyone) -->
                                <div class="col-md-6 mb-2 mb-md-0">
                                
                                    <div class="card-header">
                                    <h5 class="card-title mb-0">Share Referral Link</h5>
                                    </div>
                                   
                                    @php
                                        // fallback if controller didn’t pass it
                                        $refLink = $shareUrl ?? ( $users->referral_code ? url('/member-registration?ref='.$users->referral_code) : null );
                                    @endphp

                                    <div class="input-group">
                                        <input type="text" class="form-control" id="refLinkInput" readonly value="{{ $refLink ?? '' }}">
                                        <div class="input-group-append">
                                        <button class="btn btn-outline-secondary"
                                                type="button"
                                                onclick="if(document.getElementById('refLinkInput').value){navigator.clipboard.writeText(document.getElementById('refLinkInput').value)}"
                                                {{ empty($refLink) ? 'disabled' : '' }}>
                                            Copy
                                        </button>
                                        </div>
                                    </div>

                                    @if(empty($refLink))
                                        <small class="text-danger d-block mt-50">Referral link not available.</small>
                                    @else
                                        <small class="text-muted d-block mt-50">Share this link to add new members under you.</small>
                                    @endif
                                  
                                </div>


                            </div>

                            <!-- form -->
                            <form action="{{ url('/profile/'.$users->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control" id="id" name="id" value="{{ $users->id }}" hidden />

                                <!-- header media -->
                                <div class="media">
                                     @if($users->profile_image)
                                                <img src="{{asset('backend/uploads/members/'.$users->profile_image)}}"
                                                    id="account-upload-img" class="rounded mr-50" alt="profile image"
                                                    height="80" width="80" value="{{$users->profile_image}}" />
                                                    @else

                                                    <img src="{{asset('frontend/custom/user.png')}}"
                                                    id="account-upload-img" class="rounded mr-50" alt="profile image"
                                                    height="80" width="80"  />
                                                    @endif 

                                    <!-- upload and reset button -->
                                    <div class="media-body mt-75 ml-1">
                                        <label for="account-upload" class="btn btn-sm btn-danger mb-75 mr-75">Upload</label>
                                        <input type="file" id="account-upload" hidden accept="image/*"
                                               name="profile_image" class="@error('profile_image') is-invalid @enderror" />
                                        @error('profile_image')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <!--/ header media -->

                                <div class="row">
                                     {{-- Added By (Referrer) --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                        <label for="referrer-id">Added By (Referrer)</label>
                                        @php $currentUser = auth()->user(); @endphp

                                        @if($currentUser->role == 1)
                                            {{-- Admin: choose any role=2 user as referrer --}}
                                            <select id="referrer-id" class="form-control" name="referrer_id">
                                            <option value="">— None —</option>
                                            @foreach($possibleReferrers as $u) {{-- list excludes admins --}}
                                                <option value="{{ $u->id }}"
                                                {{ (string)old('referrer_id', $users->referrer_id) === (string)$u->id ? 'selected' : '' }}>
                                                {{ $u->id }} — {{ $u->name }} ({{ $u->email }})
                                                </option>
                                            @endforeach
                                            </select>
                                        @else
                                            {{-- Regular user: lock to existing referrer (or themselves if empty) --}}
                                            @php
                                            $lockedRefId = $users->referrer_id ?: $currentUser->id;
                                            $lockedRef   = ($users->referrer ?? $currentUser);
                                            @endphp
                                            <input type="hidden" name="referrer_id" value="{{ $lockedRefId }}">
                                            <input type="text" class="form-control"
                                                value="{{ $lockedRefId }} — {{ $lockedRef->name }} ({{ $lockedRef->email }})"
                                                readonly>
                                        @endif
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $users->name }}" required />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-e-mail">E-mail</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $users->email }}" required />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-company">Mobile</label>
                                            <input type="number" class="form-control" id="mobile" name="mobile" placeholder="+9100000000" maxlength="10" value="{{ $users->mobile }}" required />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-new-password">New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" id="account-new-password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">S/O,W/O,Mrs./Mr</label>
                                            <input type="text" id="company-column" class="form-control" name="fname" value="{{ $users->fname }}" placeholder="S/O,W/O,Mrs./Mr" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-12">
                                        <div class="form-group">
                                            <label for="fp-default">DOB</label>
                                            <input type="text" id="fp-default" class="form-control flatpickr-basic flatpickr-input active" placeholder="DD-MM-YYYY" name="dob" value="{{ $users->dob }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="g-id-column">Gender</label>
                                            {!! Form::select('gender', Config::get('constants.gender'), $users->gender, ['class'=>"form-control", 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="edu-id-column">Education</label>
                                            <input type="text" id="edu-id-column" class="form-control" name="education" placeholder="Qualification" value="{{ $users->education }}" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Occupation</label>
                                            {!! Form::select('occupation', Config::get('constants.profession'), $users->occupation, ['class'=>"form-control", 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="address-id-column">Address</label>
                                            <input type="text" id="address-column" class="form-control" placeholder="Address" name="address" value="{{ $users->address }}" required />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="station-id-column">City</label>
                                            <input type="text" id="station-column" class="form-control" placeholder="City" name="landmark" value="{{ $users->landmark }}"  />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select class="form-control" name="state" id="state" required>
                                                <option value="{{ $users->state }}">{{ $users->state }}</option>
                                                @foreach($getlist as $key=>$value)
                                                    <option value="{{ $key }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="dist-id-column">District</label>
                                            <select class="form-control" id="city" name="city" required>
                                                <option value="{{ $users->city }}">{{ $users->city }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="pin-id-column">Pincode</label>
                                            <input type="number" id="pin-column" class="form-control" placeholder="Pincode" name="pincode" value="{{ $users->pincode }}" maxlength="6" required />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="des-id-column">Designation</label>
                                            @if($users->desg == null)
                                                {!! Form::select('desg', Config::get('constants.desg'), null, ['class'=>"form-control", 'placeholder' => 'Select One...', 'required']) !!}
                                            @elseif(Auth::user()->role == 2 && $users->desg > 0)
                                                <input type="text" class="form-control" name="desg" value="{{ $users->desg }}" readonly>
                                            @elseif(Auth::user()->role == 1)
                                                {!! Form::select('desg', Config::get('constants.desg'), $users->desg, ['class'=>"form-control", 'placeholder' => 'Select One...', 'required']) !!}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="des-id-column">Blood Group</label>
                                            {!! Form::select('bloodgroup', Config::get('constants.bloodgroup'), $users->bloodgroup, ['class'=>"form-control", 'placeholder' => 'Select One...', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="des-id-column">Wings</label>
                                            @if($users->bpscell == null)
                                                {!! Form::select('bpscell', Config::get('constants.bpscell'), null, ['class'=>"form-control", 'placeholder' => 'Select Cell...', 'required']) !!}
                                            @elseif(Auth::user()->role == 2 && $users->bpscell > 0)
                                                <input type="text" class="form-control" name="bpscell" value="{{ $users->bpscell }}" readonly>
                                            @elseif(Auth::user()->role == 1)
                                                {!! Form::select('bpscell', Config::get('constants.bpscell'), $users->bpscell, ['class'=>"form-control", 'placeholder' => 'Select Cell...', 'required']) !!}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="type-id-column" class="font-weight-bolder">ID Proof</label>
                                            {!! Form::select('idtype', Config::get('constants.idtype'), $users->idtype, ['class'=>"form-control", 'placeholder' => 'Select Id Proof...', 'reqired']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="idn-id-column">ID Proof No</label>
                                            <input type="text" id="idn-id-column" class="form-control" placeholder="00000" name="id_no" value="{{ $users->id_no }}"  />
                                        </div>
                                    </div>
                                  
                               <div class="col-md-6 col-12">
  <div class="form-group">
    <label for="upload-id-column">ID Proof (front/back or single)</label>
    <input type="file" id="upload-id-column" class="form-control" name="idproof_doc" />
    <small class="text-muted d-block">Allowed JPG, PNG, GIF, or PDF. Max size 800kB</small>

    @if(!empty($users->idproof_doc))
      @php
        $idproofExt = strtolower(pathinfo($users->idproof_doc, PATHINFO_EXTENSION));
        $idproofIsImg = in_array($idproofExt, ['jpg','jpeg','png','gif','webp']);
        $idproofView = route('doc.view', ['user' => $users->id, 'type' => 'idproof']);
        $idproofDown = route('doc.download', ['user' => $users->id, 'type' => 'idproof']);
      @endphp

      <div class="card mt-75 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">ID Proof (uploaded)</h6>
          <div>
            <a href="{{ $idproofView }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
            <a href="{{ $idproofDown }}" class="btn btn-sm btn-primary">Download</a>
          </div>
        </div>
        <div class="card-body">
          @if($idproofIsImg)
            <img src="{{ $idproofView }}" alt="ID Proof" class="img-fluid rounded border">
          @elseif($idproofExt === 'pdf')
            <div class="d-flex align-items-center">
              <i data-feather="file-text" class="mr-50"></i>
              <span>PDF uploaded.</span>
              <a href="{{ $idproofView }}" target="_blank" class="ml-1">Open</a>
            </div>
          @else
            <p class="text-muted mb-0">File uploaded ({{ strtoupper($idproofExt) }}). Use the buttons above to view/download.</p>
          @endif
        </div>
      </div>
    @endif
  </div>
</div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="add-id-column" class="font-weight-bolder">Address Proof</label>
                                            {!! Form::select('addtype', Config::get('constants.addtype'), $users->addtype, ['class'=>"form-control", 'placeholder' => 'Select Address Proof...', 'reqired']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="idn-id-column">Address Proof No</label>
                                            <input type="text" id="idn-id-column" class="form-control" placeholder="00000" name="address_no" value="{{ $users->address_no }}"  />
                                        </div>
                                    </div>


<div class="col-md-6 col-12">
  <div class="form-group">
    <label for="other-doc-upload">Address/Other Document</label>
    <input type="file" id="other-doc-upload" class="form-control" name="other_doc" />
    <small class="text-muted d-block">Allowed JPG, PNG, GIF, or PDF. Max size 800kB</small>

    @php
      $hasOther = !empty($users->other_doc);
    @endphp

    @if($hasOther)
      @php
        $otherExt = strtolower(pathinfo($users->other_doc, PATHINFO_EXTENSION));
        $otherIsImg = in_array($otherExt, ['jpg','jpeg','png','gif','webp']);
        $otherView = route('doc.view', ['user' => $users->id, 'type' => 'other']);
        $otherDown = route('doc.download', ['user' => $users->id, 'type' => 'other']);
      @endphp

      <div class="card mt-75 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Address/Other Document (uploaded)</h6>
          <div>
            <a href="{{ $otherView }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
            <a href="{{ $otherDown }}" class="btn btn-sm btn-primary">Download</a>
          </div>
        </div>
        <div class="card-body">
          @if($otherIsImg)
            <img src="{{ $otherView }}" alt="Other Document" class="img-fluid rounded border">
          @elseif($otherExt === 'pdf')
            <div class="d-flex align-items-center">
              <i data-feather="file-text" class="mr-50"></i>
              <span>PDF uploaded.</span>
              <a href="{{ $otherView }}" target="_blank" class="ml-1">Open</a>
            </div>
          @else
            <p class="text-muted mb-0">File uploaded ({{ strtoupper($otherExt) }}). Use the buttons above to view/download.</p>
          @endif
        </div>
      </div>
    @else
      <p class="text-muted mb-0 mt-50">No document uploaded yet.</p>
    @endif
  </div>
</div>


                                    <div class="col-12 col-sm-6" hidden>
                                        <div class="form-group">
                                            <label for="account-name">Role</label>
                                            {!! Form::select('role', ["1"=>"Admin", "2"=>"User"], $users->role, ['class'=>"form-control", 'reqired']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6" hidden>
                                        <div class="form-group">
                                            <label for="account-name">Activate</label>
                                            {!! Form::select('useractive', Config::get('constants.status'), $users->useractive, ['class'=>"form-control", 'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div>

                                    <input type="text" class="form-control" id="valid_upto" name="valid_upto" value="{{ $users->valid_upto }}" hidden/>

                                    <div class="col-12">
                                        <input type="submit" name="submit" class="btn btn-danger" value="Save changes">
                                        <a href="{{ url('/userslist') }}" class="btn btn-outline-secondary mt-0">Go Back</a>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>
                </div>
                <!--/ right content section -->
         

                <!-- Transaction Card (Admin only) -->
                @if(Auth::user()->role == 1)
                     

                    <div class="col-md-3 mb-2 mb-md-0">

                       


                        <div class="card card-transaction">
                            <div class="card-body">

                                {{-- Affidavit (Signed upload) --}}
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-danger rounded">
                                            <div class="avatar-content"><i data-feather="archive" class="avatar-icon font-medium-3"></i></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">AffiDavit Letter</h6>
                                            <a class="text-danger" href="{{ url('/after-verify/'.$users->id) }}"><i data-feather="delete"></i>Delete</a>
                                        </div>
                                    </div>
                                    {{-- Download icon --}}
                                    <div class="font-weight-bolder text-danger">
                                      @if(!empty($users->after_verifiy_affidavit))
                                        <a href="{{ route('doc.download', ['user' => $users->id, 'type' => 'aff_after']) }}" class="text-danger">
                                          <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                        </a>
                                      @else
                                        <p>👎 Not Done</p>
                                      @endif
                                    </div>
                                </div>

                             {{-- Payment Deposit (button + latest screenshot) --}}
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-info rounded">
                                            <div class="avatar-content">
                                                <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Payment Deposit 💸</h6>
                                            <small class="text-muted d-block">Add manual payment for this member</small>
                                
                                            {{-- Button to open modal --}}
                                            <button type="button"
                                                    class="btn btn-sm btn-primary mt-50"
                                                    data-toggle="modal"
                                                    data-target="#manualPaymentModal{{ $users->id }}">
                                                Add Manual Payment
                                            </button>
                                        </div>
                                    </div>
                                
                                    {{-- Show latest payment screenshot if exists --}}
                                    @php
                                        $latestPayment = $users->latestPayment ?? null;
                                    @endphp
                                
                                    <div class="mt-75">
                                        @if($latestPayment && $latestPayment->screenshot)
                                            <small class="d-block mb-25">Last receipt uploaded:</small>
                                            <a href="{{ asset('storage/'.$latestPayment->screenshot) }}" class="text-info" target="_blank">
                                                <i data-feather="eye" class="avatar-icon font-medium-3"></i> View
                                            </a>
                                        @else
                                            <small class="text-muted">No receipt uploaded yet.</small>
                                        @endif
                                    </div>
                                </div>


                                {{-- ID Card --}}
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-success rounded">
                                            <div class="avatar-content"><i data-feather="credit-card" class="avatar-icon font-medium-3"></i></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">ID Card</h6>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder">
                                        @if(!empty($users->idcard))
                                            <a href="{{ asset('storage/'.$users->idcard) }}" class="text-success" download>
                                                <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                            </a>
                                        @else
                                            <p>Active First</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Honarary Letter --}}
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-danger rounded">
                                            <div class="avatar-content"><i data-feather="archive" class="avatar-icon font-medium-3"></i></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Honarary Letter</h6>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-danger">
                                        @if(!empty($users->honar_letter))
                                            <a href="{{ asset('storage/'.$users->honar_letter) }}" class="text-danger" download>
                                                <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                            </a>
                                        @else
                                            <p>Active First</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Official Letters --}}
                                <!--<div class="transaction-item">-->
                                <!--    <div class="media">-->
                                <!--        <div class="avatar bg-light-primary rounded">-->
                                <!--            <div class="avatar-content"><i data-feather="file-text" class="avatar-icon font-medium-3"></i></div>-->
                                <!--        </div>-->
                                <!--        <div class="media-body">-->
                                <!--            <h6 class="transaction-title">Membership Letter</h6>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--    <div class="font-weight-bolder text-primary">-->
                                <!--        @if(!empty($users->appointment_letter))-->
                                <!--            <a href="{{ asset('storage/'.$users->appointment_letter) }}" download>-->
                                <!--                <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>-->
                                <!--            </a>-->
                                <!--        @else-->
                                <!--            <p>Active First</p>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-primary rounded">
                                            <div class="avatar-content"><i data-feather="file-text" class="avatar-icon font-medium-3"></i></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Certificate</h6>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-primary">
                                        @if(!empty($users->official_2))
                                            <a href="{{ asset('storage/'.$users->official_2) }}" download>
                                                <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                            </a>
                                        @else
                                            <p>Active First</p>
                                        @endif
                                    </div>
                                </div>

                                <!--<div class="transaction-item">-->
                                <!--    <div class="media">-->
                                <!--        <div class="avatar bg-light-primary rounded">-->
                                <!--            <div class="avatar-content"><i data-feather="file-text" class="avatar-icon font-medium-3"></i></div>-->
                                <!--        </div>-->
                                <!--        <div class="media-body">-->
                                <!--            <h6 class="transaction-title">Offical Letter SP</h6>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--    <div class="font-weight-bolder text-primary">-->
                                <!--        @if(!empty($users->official_2))-->
                                <!--            <a href="{{ asset('storage/'.$users->official_2) }}" download>-->
                                <!--                <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>-->
                                <!--            </a>-->
                                <!--        @else-->
                                <!--            <p>Active First</p>-->
                                <!--        @endif-->
                                <!--    </div>-->
                                <!--</div>-->

                                {{-- Payment Receipt (generated receipt) --}}
                                <div class="transaction-item">
                                    <div class="media">
                                        <div class="avatar bg-light-info rounded">
                                            <div class="avatar-content"><i data-feather="pocket" class="avatar-icon font-medium-3"></i></div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="transaction-title">Payment Receipt💰</h6>
                                        </div>
                                    </div>
                                    <div class="font-weight-bolder text-danger">
                                        @if(!empty($payment) && !empty($payment->payment_rec))
                                            <a href="{{ asset('storage/'.$payment->payment_rec) }}" class="text-danger" download>
                                                <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                            </a>
                                        @else
                                            <p>👎 Not Done</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                <!--/ Transaction Card -->
            </div>
        </section>
    </div>
</div>

{{-- Manual Payment Modal --}}
<div class="modal fade" id="manualPaymentModal{{ $users->id }}" tabindex="-1" role="dialog" aria-labelledby="manualPaymentModalLabel{{ $users->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualPaymentModalLabel{{ $users->id }}">
                    Add Manual Payment – {{ $users->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.members.payments.manual', $users->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label>Amount (₹) <span class="text-danger">*</span></label>
                        <input type="number"
                               name="amount"
                               class="form-control"
                               placeholder="Membership Fees"
                               value="{{ old('amount') }}"
                               min="1"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Payment Method (optional)</label>
                        <input type="text"
                               name="method"
                               class="form-control"
                               placeholder="Cash / NEFT / UPI / Other"
                               value="{{ old('method') }}">
                    </div>

                    <div class="form-group">
                        <label>Note (optional)</label>
                        <input type="text"
                               name="note"
                               class="form-control"
                               placeholder="Any remarks..."
                               value="{{ old('note') }}">
                    </div>

                    <div class="form-group">
                        <label>Upload Receipt / Screenshot (optional)</label>
                        <input type="file"
                               name="screenshot"
                               class="form-control"
                               accept="image/*,application/pdf">
                        <small class="text-muted d-block">Allowed: JPG, PNG, PDF (max 2MB)</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script type='text/javascript'>

    jQuery('#state').change(function(){
        // console.log('im in');
                    let sid=jQuery(this).val();
                    console.log(sid);
                    jQuery.ajax({
                        url:'/city-list',
                        type:'post',
                        data:'sid='+sid+'&_token={{csrf_token()}}',
                        success:function(result){
                            jQuery('#city').html(result)
                        }
                    });
                });
    
        </script>

@endsection
