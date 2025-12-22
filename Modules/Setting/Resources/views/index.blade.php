@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">General Settings</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Pages</a>
                            </li>
                            <li class="breadcrumb-item active"> Site Settings
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
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column nav-left">
                        <!-- general -->
                        <li class="nav-item">
                            <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                                href="#account-vertical-general" aria-expanded="true">
                                <i data-feather="user" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">General Setting</span>
                            </a>
                        </li>
                        <!-- change password -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-password" data-toggle="pill"
                                href="#account-vertical-password" aria-expanded="false">
                                <i data-feather="lock" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">SMTP Settings</span>
                            </a>
                        </li>
                        <!-- location (map) -->
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-location" data-toggle="pill"
                                href="#account-vertical-location" aria-expanded="false">
                                <i data-feather="map-pin" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Location</span>
                            </a>
                        </li>
                        <!-- analytics -->
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="account-pill-password" data-toggle="pill"
                                href="#account-vertical-password" aria-expanded="false">
                                <i data-feather="bar-chart" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Google Analytics</span>
                            </a>
                        </li> --}}
                        <!-- social -->
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="account-pill-social" data-toggle="pill"
                                href="#account-vertical-social" aria-expanded="false">
                                <i data-feather="link" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">Social Links</span>
                            </a>
                        </li> --}}

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
                                    <form class="form form-horizontal" method="post"
                                        action="{{ url('settings/') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input id="id" type="text" class="form-control" name="id"
                                            value="{{ $settings->id }}" hidden>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-username">Site Url</label>
                                                    <input type="text" id="site_url" class="form-control"
                                                        name="site_url" placeholder=""
                                                        value="{{ $settings->site_url }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-name">Site Email</label>
                                                    <input type="text" class="form-control" id="site_email"
                                                        name="site_email" placeholder="Name"
                                                        value="{{ $settings->site_email }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="title">Site Title</label>
                                                    <input type="title" class="form-control" id="title" name="title"
                                                        placeholder="" value="{{ $settings->title }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords</label>
                                                    <input type="text" class="form-control" id="meta_keywords"
                                                        name="meta_keywords" placeholder=""
                                                        value="{{ $settings->meta_keywords }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-company">Meta Description</label>
                                                    <input type="text" class="form-control" id="meta_description"
                                                        name="meta_description" placeholder=""
                                                        value="{{ $settings->meta_description }}" />
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-company">Meta Author</label>
                                                    <input type="text" class="form-control" id="meta_author"
                                                        name="meta_author" placeholder=""
                                                        value="{{ $settings->meta_author }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea class="form-control" id="address" name="address"
                                                        placeholder="" value="">{{ $settings->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" class="form-control" id="account-company"
                                                        name="phone" placeholder="" value="{{ $settings->phone }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group">
                                                    <label for="account-company">Ngo 80G No.</label>

                                                     <input type="text" class="form-control" id="company-no" name="company_no" placeholder="Company No" value="{{$setting->company_no}}" />
                                                </div>
                                            </div>
                                             <div class="col-12 col-sm-3">
                                                <div class="form-group">
                                                    <label for="account-company">Ngo Registration No.</label>

                                                     <input type="text" class="form-control" id="company-no" name="reg_no" placeholder="Regd No" value="{{$setting->reg_no}}" />
                                                </div>
                                            </div>
                                              <div class="col-12 col-sm-3">
                                                <div class="form-group">
                                                    <label for="account-company">Ngo PAN No.</label>
                                                  
                                                     <input type="text" class="form-control" id="company-no" name="pan_no" placeholder="PAN No" value="{{$setting->pan_no}}" />
                                                </div>
                                            </div>
                                              <div class="col-12 col-sm-3">
                                                <div class="form-group">
                                                    <label for="account-company"> TAN No.</label>
                                                  
                                                     <input type="text" class="form-control" id="company-no" name="tan_no" placeholder="TAN No" value="{{$setting->tan_no}}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group">
                                                    <label for="account-company">CIN No.</label>
                                                  
                                                     <input type="text" class="form-control" id="company-no" name="cin_no" placeholder="CIN No" value="{{$setting->cin_no}}" />
                                                </div>
                                            </div>
                                           

                                                <div class="col-12 col-sm-6">
                                                          <div class="border rounded p-2">
                                                            <h4 class="mb-1">Company Stamp</h4>
                                                            <div class="media flex-column flex-md-row breadcrumb-media">
                                                              <img src="{{asset('backend/uploads/'.$settings->company_stamp)}}" 
                                                                   id="breadcrumb-preview" 
                                                                   class="rounded mr-2 mb-1 mb-md-0" 
                                                                   width="170" height="110" 
                                                                   alt="Breadcrumb Image" />
                                                        
                                                              <div class="media-body">
                                                                <p class="my-50">
                                                                  <a href="javascript:void(0);" id="breadcrumb-image-text">
                                                                    Required image resolution 312x312, image size 10 MB.
                                                                  </a>
                                                                </p>
                                                                <div class="d-inline-block">
                                                                  <div class="form-group mb-0">
                                                                    <div class="custom-file">
                                                                      <input type="file" 
                                                                             name="company_stamp" 
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

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-company">Header Logo</label>
                                                    <!-- header media -->
                                                    <div class="media">
                                                        <a href="javascript:void(0);" class="mr-25">
                                                            <img src="{{ asset('backend/uploads/'.$settings->site_logo) }}"
                                                                id="account-upload-img" class="rounded mr-50"
                                                                alt="site logo" width="246.73" value="" />
                                                        </a>
                                                        <!-- upload and reset button -->
                                                        <div class="media-body mt-75 ml-1">
                                                            <label for="account-upload"
                                                                class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                            <input type="file" id="account-upload" hidden
                                                                accept="image/*" name="site_logo" />
                                                            <button
                                                                class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                            <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                                                        </div>
                                                        <!--/ upload and reset button -->
                                                    </div>
                                                    <!--/ header media -->
                                                </div>
                                            </div>
                                              <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-company">Favicon Icon</label>
                                                    <!-- header media -->
                                                    <div class="media">
                                                        <a href="javascript:void(0);" class="mr-25">
                                                            <img src="{{ asset('backend/icons/'.$settings->favicon_icon) }}"
                                                                id="favicon-img" class="rounded mr-50" alt="favicon"
                                                                height="50" width="50" value="" />
                                                        </a>
                                                        <!-- upload and reset button -->
                                                        <div class="media-body mt-75 ml-1">
                                                            <label for="favicons"
                                                                class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                                            <input type="file" id="favicons" hidden accept="image/*"
                                                                name="favicon_icon" />
                                                            <button
                                                                class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                            <p>Allowed JPG, GIF or PNG. Max size of 250kB</p>
                                                        </div>
                                                        <!--/ upload and reset button -->
                                                    </div>
                                                    <!--/ header media -->
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-facebook">Facebook</label>
                                                    <input type="text" id="account-facebook" class="form-control"
                                                        name="facebook_url" value="{{ $settings->facebook_url }}"
                                                        placeholder="Add link" />
                                                </div>
                                            </div>
                                            <!-- instagram link input -->
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-instagram">Instagram</label>
                                                    <input type="text" id="account-instagram" class="form-control"
                                                        name="insta_url" value="{{ $settings->insta_url }}"
                                                        placeholder="Add link" />
                                                </div>
                                            </div>
                                            <!-- linkedin link input -->
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-linkedin">LinkedIn</label>
                                                    <input type="text" id="account-linkedin" class="form-control"
                                                        name="linkdin_url" placeholder="Add link"
                                                        value="{{ $settings->linkdin_url }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-linkedin">Twitter</label>
                                                    <input type="text" id="account-linkedin" class="form-control"
                                                        name="twitter" placeholder="Add link"
                                                        value="{{ $settings->twitter }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="account-youtube">Youtube Channel</label>
                                                    <input type="text" id="account-youtube" class="form-control"
                                                        name="twitter" placeholder="Add link"
                                                        value="{{ $settings->youtube }}" />
                                                </div>
                                            </div>
                                            

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mt-2 mr-1">Save
                                                    changes</button>
                                                <button type="reset"
                                                    class="btn btn-outline-secondary mt-2">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>

                                <!-- location tab -->
                                <div role="tabpanel" class="tab-pane" id="account-vertical-location"
                                     aria-labelledby="account-pill-location" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-12 col-lg-7">
                                            <form class="form" method="post" action="{{ url('/settings/location') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="map-embed">Google Map Iframe or URL</label>
                                                    <textarea id="map-embed" name="map_embed" class="form-control" rows="6" placeholder="Paste Google Maps embed iframe or the embed URL here">{{ old('map_embed', $settings->map_embed ?? '') }}</textarea>
                                                    <small class="text-muted">You can paste the full &lt;iframe&gt; code from Google Maps, or just the embed URL. This shows on the Contact page map.</small>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Location</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--/ general tab -->

                                <!-- change smtp Setting -->
                                <div class="tab-pane fade" id="account-vertical-password" role="tabpanel"
                                    aria-labelledby="account-pill-password" aria-expanded="false">
                                   <div class="row">
                                        <div class="col-7 mt-5">
                                            <!-- form -->
                                            <form class="" method="post"
                                                action="{{ url('/smtp-settings') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                {{-- @method('PUT') --}}
                                                <input id="id" type="text" class="form-control" name="id" value="" hidden>

                                                <div class="form-group">
                                                    <label
                                                        for="site_smtp_mail_mailer">{{ __('SMTP Mailer') }}</label>
                                                    <select name="site_smtp_mail_mailer" class="form-control">
                                                        <option value="smtp"
                                                            @if(get_static_option('site_smtp_mail_mailer')=='smtp' )
                                                            selected @endif>{{ __('SMTP') }}</option>
                                                        <option value="sendmail"
                                                            @if(get_static_option('site_smtp_mail_mailer')=='sendmail' )
                                                            selected @endif>{{ __('SendMail') }}</option>
                                                        <option value="mailgun"
                                                            @if(get_static_option('site_smtp_mail_mailer')=='mailgun' )
                                                            selected @endif>{{ __('Mailgun') }}</option>
                                                        <option value="postmark"
                                                            @if(get_static_option('site_smtp_mail_mailer')=='postmark' )
                                                            selected @endif>{{ __('Postmark') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="site_smtp_mail_host">{{ __('SMTP Mail Host') }}</label>
                                                    <input type="text" name="site_smtp_mail_host" class="form-control"
                                                        value="{{ get_static_option('site_smtp_mail_host') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="site_smtp_mail_port">{{ __('SMTP Mail Port') }}</label>
                                                    <select name="site_smtp_mail_port" class="form-control">
                                                        <option value="587"
                                                            @if(get_static_option('site_smtp_mail_port')=='587' ) selected
                                                            @endif>{{ __('587') }}</option>
                                                        <option value="465"
                                                            @if(get_static_option('site_smtp_mail_port')=='465' ) selected
                                                            @endif>{{ __('465') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="site_smtp_mail_username">{{ __('SMTP Mail Username') }}</label>
                                                    <input type="text" name="site_smtp_mail_username" class="form-control"
                                                        value="{{ get_static_option('site_smtp_mail_username') }}"
                                                        id="site_smtp_mail_username">
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="site_smtp_mail_password">{{ __('SMTP Mail Password') }}</label>
                                                    <input type="password" name="site_smtp_mail_password"
                                                        class="form-control"
                                                        value="{{ get_static_option('site_smtp_mail_password') }}"
                                                        id="site_smtp_mail_password">
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="site_smtp_mail_encryption">{{ __('SMTP Mail Encryption') }}</label>
                                                    <select name="site_smtp_mail_encryption" class="form-control">
                                                        <option value="ssl"
                                                            @if(get_static_option('site_smtp_mail_encryption')=='ssl' )
                                                            selected @endif>{{ __('SSL') }}</option>
                                                        <option value="tls"
                                                            @if(get_static_option('site_smtp_mail_encryption')=='tls' )
                                                            selected @endif>{{ __('TLS') }}</option>
                                                    </select>
                                                </div>



                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 mr-1">Save
                                                        changes</button>
                                                    <button type="reset"
                                                        class="btn btn-outline-secondary mt-1">Cancel</button>
                                                </div>
                                    
                                            </form>
                                        <!--/ form -->
                                        </div>

                                        {{-- </div> --}}
                                        <!--change smtp Setting -->
                                        <div class="col-5 mt-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="header-title">{{ __("SMTP Test") }}</h4>
                                                    <form action="{{ url('/smtp-test') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="email">{{ __('Email') }}</label>
                                                            <input type="email" name="email" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="subject">{{ __('Subject') }}</label>
                                                            <input type="text" name="subject" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message">{{ __('Message') }}</label>
                                                            <textarea name="message" class="form-control" cols="30"
                                                                rows="10"></textarea>
                                                        </div>
                                                        <button id="send" type="submit"
                                                            class="btn btn-primary mt-4 pr-4 pl-4">{{ __('Send Mail') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                </div>

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
</div>
@endsection
@section('script')
    <script>
        <x-btn.update/>
        <x-btn.send/>
    </script>
@endsection
