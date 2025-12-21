@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="content-body">
        <!-- account setting page -->
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column nav-left">
                        <!-- general -->
                        <li class="nav-item">
                            <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                                href="#account-vertical-general" aria-expanded="true">
                                <i data-feather="user" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Users Details</span>
                            </a>
                        </li>

                        <!-- notification -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                <i data-feather="list" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Notes</span>
                            </a>
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
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                     aria-labelledby="account-pill-general" aria-expanded="true">

                                    <!-- form -->
                                    <form action="{{ url('/admins-update/'.$users->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-control" id="id" name="id" value="{{ $users->id }}" hidden />

                                        <!-- header media -->
                                        <div class="media">
                                            @if($users->profile_image)
                                                <img src="{{asset('backend/uploads/admin/'.$users->profile_image) }}"
                                                     id="account-upload-img" class="rounded mr-50" alt="profile image"
                                                     height="80" width="80" />
                                            @else
                                                <img src="{{ asset('frontend/custom/user.png') }}"
                                                     id="account-upload-img" class="rounded mr-50" alt="profile image"
                                                     height="80" width="80" />
                                            @endif

                                            <!-- upload and reset button -->
                                            <div class="media-body mt-75 ml-1">
                                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                <input type="file" id="account-upload" hidden accept="image/*" name="profile_image" />
                                                <button class="btn btn-sm btn-outline-secondary mb-75" type="reset">Reset</button>
                                                <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div>
                                        <!--/ header media -->

                                        {{-- Generated documents quick links --}}
                                        @if(
                                            !empty($users->idcard) ||
                                            !empty($users->appointment_letter) ||
                                            !empty($users->official_1) ||
                                            !empty($users->official_2) ||
                                            !empty($users->honar_letter) ||
                                            !empty($users->before_affidavit) ||
                                            (isset($payment) && !empty($payment->payment_rec))
                                        )
                                            <div class="alert alert-secondary mt-2" role="alert">
                                                <div class="d-flex flex-wrap align-items-center">
                                                    @if(!empty($users->idcard))
                                                        <a class="mr-2 mb-1 btn btn-sm btn-outline-primary"
                                                           href="{{ asset('storage/'.$users->idcard) }}" target="_blank">
                                                            View ID Card
                                                        </a>
                                                    @endif

                                                    @if(!empty($users->appointment_letter))
                                                        <a class="mr-2 mb-1 btn btn-sm btn-outline-primary"
                                                           href="{{ asset('storage/'.$users->appointment_letter) }}" target="_blank">
                                                            View Joining Letter
                                                        </a>
                                                    @endif

                                                    @if(!empty($users->official_1))
                                                        <a class="mr-2 mb-1 btn btn-sm btn-outline-primary"
                                                           href="{{ asset('storage/'.$users->official_1) }}" target="_blank">
                                                            View Official Letter 1
                                                        </a>
                                                    @endif

                                                    @if(!empty($users->official_2))
                                                        <a class="mr-2 mb-1 btn btn-sm btn-outline-primary"
                                                           href="{{ asset('storage/'.$users->official_2) }}" target="_blank">
                                                            View Official Letter 2
                                                        </a>
                                                    @endif

                                                    @if(!empty($users->honar_letter))
                                                        <a class="mr-2 mb-1 btn btn-sm btn-outline-primary"
                                                           href="{{ asset('storage/'.$users->honar_letter) }}" target="_blank">
                                                            View Honor Letter
                                                        </a>
                                                    @endif

                                                    @if(!empty($users->before_affidavit))
                                                        <a class="mr-2 mb-1 btn btn-sm btn-outline-primary"
                                                           href="{{ asset('storage/'.$users->before_affidavit) }}" target="_blank">
                                                            View Affidavit
                                                        </a>
                                                    @endif

                                                    @isset($payment)
                                                        @if(!empty($payment->payment_rec))
                                                            <a class="mr-2 mb-1 btn btn-sm btn-outline-primary"
                                                               href="{{ asset('storage/'.$payment->payment_rec) }}" target="_blank">
                                                                View Receipt
                                                            </a>
                                                        @endif
                                                    @endisset
                                                </div>
                                            </div>
                                        @endif
                                        {{-- /Generated documents quick links --}}

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           placeholder="Name" value="{{ $users->name }}" reqired />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-e-mail">E-mail</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           placeholder="Email" value="{{ $users->email }}" reqired />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-company">Mobile</label>
                                                    <input type="number" class="form-control" id="mobile" name="mobile"
                                                           placeholder="+9100000000" value="{{ $users->mobile }}" reqired />
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-name">Role</label>
                                                    {!! Form::select('role', ["1"=>"Admin", "3"=>"Manager"], $users->role, ['class'=>"form-control", 'reqired']) !!}
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-name">Status</label>
                                                    {!! Form::select('useractive', Config::get('constants.status'), $users->useractive, ['class'=>"form-control", 'placeholder' => 'Select One...', 'reqired']) !!}
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-new-password">New Password</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" id="account-new-password" name="password"
                                                               class="form-control @error('password') is-invalid @enderror"
                                                               placeholder="New Password" value="" />
                                                        <div class="input-group-append">
                                                            <div class="input-group-text cursor-pointer">
                                                                <i data-feather="eye"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <input type="submit" name="submit" class="btn btn-primary" value="Save changes">
                                                <button type="reset" class="btn btn-outline-secondary mt-0">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>
                                <!--/ general tab -->

                                <!-- change Notes Setting -->
                                <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel"
                                     aria-labelledby="account-pill-notifications" aria-expanded="false">

                                    <!-- form -->
                                    <form action="{{ url('/add-notes') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <input type="text" class="form-control" id="id" name="admin_id" value="{{ $users->id }}" hidden/>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="note">Add Notes</label>
                                                    <textarea class="form-control" name="notes" row="30" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mt-1 mr-1">Save changes</button>
                                                <a  href="{{url('/users')}}" class="btn btn-outline-secondary mt-1">Go Back</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->

                                    <div class="col-lg-8 col-12">
                                        <div class="card card-user-timeline">
                                            <div class="card-header">
                                                <div class="d-flex align-items-center">
                                                    <i data-feather="list" class="user-timeline-title-icon"></i>
                                                    <h4 class="card-title">Notes List</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <ul class="timeline ml-50">
                                                    @if(count($notes) > 0)
                                                        @foreach($notes as $data)
                                                            <li class="timeline-item">
                                                                <span class="timeline-point timeline-point-indicator"></span>
                                                                <div class="timeline-event">
                                                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                                        <h6>{{ $data->notes }}</h6>
                                                                        <span class="timeline-event-time mr-1">{{ $data->created_at->diffForHumans() }}</span>
                                                                    </div>

                                                                    <div class="media align-items-center">
                                                                        <a href="#" data-toggle="modal" data-target="#editnote{{ $data->id }}" data-id="{{ $data->id }}">
                                                                            <h6 class="media-body mb-0 text-primary">Edit</h6>
                                                                        </a>
                                                                        <a href="{{ url('/notes-del/'.$data->id) }}"
                                                                           onclick="event.preventDefault(); document.getElementById('delete-post-{{ $data->id }}').submit();">
                                                                            <h6 class="media-body mb-0 ml-2 text-danger">Delete</h6>
                                                                        </a>
                                                                        <form id="delete-post-{{ $data->id }}"
                                                                              action="{{ url('/notes-del/'.$data->id) }}" method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <div class="modal fade text-left" id="editnote{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editnote{{ $data->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="editnote{{ $data->id }}">Edit Note</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="{{ url('/notes-edit/'.$data->id) }}" id="{{ $data->id }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-body">
                                                                                <input type="text" id="id" class="form-control" name="id" value="{{ $data->id }}" hidden />
                                                                                <input type="text" class="form-control" id="user_logid" name="user_logid" value="{{ $data->admin_id }}" hidden/>

                                                                                <div class="row">
                                                                                    <div class="col-md-12 col-12">
                                                                                        <div class="form-group">
                                                                                            <label for="note">Add Notes</label>
                                                                                            <textarea class="form-control" name="notes" row="3">{{ $data->notes }}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary">Save Change</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--/ change Notes Setting -->

                            </div>

                        </div>
                    </div>
                </div>
                <!--/ right content section -->

            </div>
        </section>
    </div>
</div>

@endsection
