@extends('layouts.app')

@section('content')

<!-- 
<div class="app-content content "> -->
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <div class="content-body">
        <!-- account setting page -->
        <section id="page-account-settings">
            <div class="row">

                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">

                            <!-- general tab -->


                            <!-- form -->
                            <form action="{{url('/admins')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="text" class="form-control" id="id" name="id" value=""
                                    hidden />
                                <!-- header media -->
                                <div class="media">
                                    <a href="javascript:void(0);" class="mr-25">
                                        
                                        <img src="{{asset('frontend/custom/user.png')}}"
                                            id="account-upload-img" class="rounded mr-50" alt="profile image"
                                            height="80" width="80" value="" />
                                    </a>
                                    <!-- upload and reset button -->
                                    <div class="media-body mt-75 ml-1">
                                        <label for="account-upload"
                                            class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                        <input type="file" id="account-upload" hidden accept="image/*"
                                            name="profile_image" />
                                        <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                        <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <!--/ header media -->
                                <div class="row">
                                    <!-- <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="account-username">Username</label>
                                                        <input type="text" class="form-control" id="account-username"
                                                            name="username" placeholder="Username" value="johndoe" />
                                                    </div>
                                                </div> -->
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Name" value="" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-e-mail">E-mail</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email" value="" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-company">Mobile</label>
                                            <input type="number" class="form-control" id="mobile" name="mobile"
                                                placeholder="+9100000000" value=""  maxlength="10" pattern="[0-9]{10}"/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Role</label>
                                            {!! Form::select('role', ["1"=>"Admin", "3"=>"Manager" ], null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Status</label>
                                            {!! Form::select('useractive', Config::get('constants.status'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-new-password">Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" id="account-new-password" name="password"
                                                    class="form-control" placeholder="New Password" value="" />
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
                                        <a  href="{{url('/users')}}" class="btn btn-outline-secondary mt-1">Go Back</a>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->

                            <!--/ general tab -->

                        </div>
                    </div>
                </div>
                <!--/ right content section -->
            </div>
    </div>
    </section>

</div>
</div>

@endsection

