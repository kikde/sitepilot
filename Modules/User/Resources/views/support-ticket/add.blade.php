@extends('layouts.app')

@section('content')

<!-- 
<div class="app-content content "> -->
<div class="content-overlay"></div>
<div class="header-navbar-shadow">

</div>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">New Ticket</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">New Ticket</a>
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


                            <!-- form -->
                            <form action="{{url('/support-tickets')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="text" class="form-control" id="id" name="id" value=""
                                    hidden />
                            
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
                                            <label for="account-name">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="title" value="" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-e-mail">Subject</label>
                                            <input type="text" class="form-control"  name="subject"
                                                placeholder="Subject" value="" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-company">Priority</label>
                                            <select name="priority" class="form-control">
                                                <option value="low">{{__('Low')}}</option>
                                                <option value="medium">{{__('Medium')}}</option>
                                                <option value="high">{{__('High')}}</option>
                                                <option value="urgent">{{__('Urgent')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Departments</label>
                                            <select name="department_id" class="form-control">
                                                @foreach($all_departments as $dep)
                                                <option value="{{$dep->id}}">{{$dep->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">User</label>
                                            <select name="user_id" class="form-control nice-select wide">
                                                @foreach($all_users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    {{-- <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Status</label>
                                            {!! Form::select('status', Config::get('constants.status'), null, ['class'=>"form-control",'placeholder' => 'Select One...', 'reqired']) !!}
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="account-name">Description</label>
                                            <textarea name="description"class="form-control" cols="30" rows="10" placeholder="{{__('Description')}}"></textarea>
                                        </div>
                                    </div>

                                   
                                    <div class="col-12">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit Ticket">
                                        <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
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
<script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var $selector = $('.nice-select');
            if($selector.length > 0){
                $selector.niceSelect();
            }
        });
    </script>
@endsection

    
