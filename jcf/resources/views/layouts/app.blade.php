
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{$setting->meta_description}}">
    <meta name="keywords" content="{{$setting->meta_keywords}}">
    <meta name="author" content="{{$setting->meta_author}}">
    <title>{{$setting->title}}</title>
    <link rel="apple-touch-icon" href="{{asset('backend/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/icons/'.$setting->favicon_icon)}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }} " >
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/charts/apexcharts.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/extensions/toastr.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/editors/quill/katex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/extensions/jquery.rateyo.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/forms/form-validation.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/extensions/ext-component-toastr.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/forms/form-wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/pages/page-auth.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/forms/form-quill-editor.css')}}">
  
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/pages/page-blog.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/pages/app-invoice-list.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/extensions/ext-component-ratings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/forms/pickers/form-pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/forms/form-file-uploader.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
   
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->

    <link rel="stylesheet" href="{{asset('backend/assets/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/media-uploader.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datepicker.min.css')}}">

    
<style>
  /* allow wrapping & avoid clipping inside a flex row */
  .brand-wrap{
    white-space: normal;
    overflow-wrap: anywhere;
    word-break: break-word;     /* fallback */
    line-height: 1.1;
  }
  /* make sure brand area can shrink/grow in flex without hiding text */
  .navbar-header .navbar-brand,
  .navbar-header .navbar-brand *{ min-width: 0; }

  /* optionally cap width on small screens so it doesn't collide with toggle */
  @media (max-width: 1199.98px){
    .brand-wrap{ max-width: calc(100vw - 160px); }
  }
</style>

    <!-- END: Custom CSS-->
<style>
/* Smooth horizontal scroll on mobile */
.mobile-table{
  overflow-x: auto;
  -webkit-overflow-scrolling: touch; /* momentum */
  position: relative;
}

/* Give the table a minimum width so columns don’t squash to unreadable */
.mobile-table table{
  min-width: 900px; /* adjust if you hide fewer columns; 900–1100 works well */
}

/* Optional: subtle gradient hint when there is more content to the right */
.mobile-table::after{
  content: "";
  position: absolute;
  top: 0; right: 0;
  width: 24px; height: 100%;
  pointer-events: none;
  background: linear-gradient(to left, rgba(0,0,0,0.06), rgba(0,0,0,0));
  display: none;
}
.mobile-table.is-scrollable::after{ display: block; }

/* Make cells keep content on a single line so the row height stays small */
.mobile-table td, .mobile-table th{
  white-space: nowrap;
}

/* On very small screens, reduce padding for more content per row */
@media (max-width: 576px){
  .mobile-table td, .mobile-table th{
    padding-left: 0.6rem;
    padding-right: 0.6rem;
  }
}
</style>

    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@44.3.0/build/ckeditor.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    @stack('top_style')

   
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> --}}
    {{-- <script src="{{asset('backend/assets/js/bootstrap-datepicker.min.js')}}"></script> --}}
   
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    @stack('menus')
    @include('backend.partials.header')
    @include('backend.partials.sidebar')

    <div class="app-content content">
        <div class="container">
            @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show mx-5" role="alert">
                            <strong>{{ session()->get('message') }}</strong>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                     @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                    @endif
        </div>
        @yield('content')
    </div>
    
    @include('backend.partials.footer')

    <script src="{{asset('backend/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/core/app.js')}}"></script>

      <!-- BEGIN: Page Vendor JS-->
      <script src="{{asset('backend/app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
      {{-- <script src="{{asset('backend/app-assets/vendors/js/extensions/toastr.min.js')}}"></script> --}}
  
      <script src="{{asset('backend/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
    
      <script src="{{asset('backend/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
      {{-- <script src="{{asset('backend/assets/js/dropzone.js')}}"></script> --}}
       <script src="{{asset('backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
      <script src="{{asset('backend/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
      <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->

    <script src="{{asset('backend/app-assets/js/scripts/forms/form-wizard.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/pages/app-invoice-list.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/extensions/ext-component-ratings.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/pages/page-blog-edit.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/forms/form-file-uploader.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/pages/page-account-settings.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/forms/form-select2.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/forms/form-tooltip-valid.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
    <!-- END: Page JS-->
  
 <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    {{-- @stack('bottom_script') --}}



    <script>
document.addEventListener('DOMContentLoaded', function(){
  const wraps = document.querySelectorAll('.mobile-table');
  wraps.forEach(w => {
    const togg = () => {
      w.classList.toggle('is-scrollable', w.scrollWidth > w.clientWidth);
    };
    togg();
    window.addEventListener('resize', togg, {passive:true});
  });
});
</script>

</body>

</html>
