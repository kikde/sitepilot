<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="{{$setting->meta_description}}">
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="author" content="{{$setting->meta_author}}">
<title>{{$setting->title}}</title>

<!-- Fav Icon -->
<link rel="icon" href="{{asset('backend/icons/'.$setting->favicon_icon)}}" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{asset('frontend/assets/css/font-awesome-all.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/flaticon.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/owl.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/animate.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/nice-select.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/jquery-ui.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/jquery.bootstrap-touchspin.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/color.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="{{asset('frontend/custom/navbottom/app.css')}}"> -->
</head>

<!-- page wrapper -->
<body>

    <div class="boxed_wrapper red-color">

    @includeFirst([
      "frontend.partials.header." . ($theme['header'] ?? 'header'),
      "frontend.partials.header.style-2"
    ])

@yield('content')

@includeFirst([
      "frontend.partials.footer." . ($theme['footer'] ?? 'footer'),
      "frontend.partials.footer.style-2"
    ])


@include ("frontend.partials.whatsapp.whatsapp")

  {{-- @include ("frontend.partials.whatsapp.bottom-1")--}} 


 <!-- App Download Popup -->
<div id="appDownloadPopup" class="app-popup-backdrop" style="display:none;">
    <div class="app-popup-card">
        <button class="app-popup-close" aria-label="Close popup">&times;</button>

        <img src="{{ asset('backend/icons/'.$setting->favicon_icon) }}" alt="App Icon" class="app-popup-icon"> <!-- optional -->

        <h2 class="app-popup-title">Download Our Mobile App</h2>
        <p class="app-popup-text">
            Get faster updates, donate easily, and stay connected with {{$setting->title}} directly from our app.
        </p>

        <a href="https://play.google.com/store/apps/details?id=YOUR_APP_PACKAGE"
           target="_blank"
           class="app-popup-playstore-btn"
           rel="noopener">
            <!-- You can replace this with a Play Store image if you like -->
            <span>Get it on</span>
            <strong>Google Play</strong>
        </a>
    </div>
</div>



 <!-- jequery plugins -->
    <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/owl.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/validation.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('frontend/assets/js/appear.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.countTo.js')}}"></script>
    <script src="{{asset('frontend/assets/js/scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bxslider.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>

    <script src="{{asset('backend/app-assets/js/scripts/components/components-modals.js')}}"></script>


     <!-- map script -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
     <script src="{{asset('frontend/assets/js/gmaps.js')}}"></script>
     <script src="{{asset('frontend/assets/js/map-helper.js')}}"></script>
     

    <!-- main-js -->
    <script src="{{asset('frontend/assets/js/script.js')}}"></script>
     <!-- <script src="{{asset('frontend/custom/navbottom/app.js')}}"></script> -->

<script>
  // mark active based on current path
  (function () {
    const norm = p => (p || "/").replace(/\/+$/,"");  // trim trailing slash
    const here = norm(location.pathname);

    document.querySelectorAll('.bottom-nav .nav a[href]').forEach(a => {
      const url = new URL(a.getAttribute('href'), location.origin);
      if (norm(url.pathname) === here) a.classList.add('active');
    });

    // (optional) visual feedback before navigation
    document.querySelectorAll('.bottom-nav .nav > li a').forEach(a=>{
      a.addEventListener('click', () => {
        document.querySelectorAll('.bottom-nav .nav > li a')
          .forEach(x=>x.classList.remove('active'));
        a.classList.add('active');
      });
    });
  })();
</script>

<script>
        
 // Initialize the official widget (no custom bridging)
 function googleTranslateElementInit(){
    new google.translate.TranslateElement({
      pageLanguage:'en',
      includedLanguages:'ar,bn,en,gu,hi,kn,ml,mr,pa,ta,te,ur',
      autoDisplay:true
    }, 'google_translate_element');  

  }

  (function(){
    if (window.__gt_loaded) return; window.__gt_loaded = true;
    var s=document.createElement('script');
    s.src='https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    s.async=true; document.head.appendChild(s);
  })();
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var popup      = document.getElementById('appDownloadPopup');
    var closeBtn   = popup ? popup.querySelector('.app-popup-close') : null;

    // Don't show again if user already closed it
    var alreadyClosed = localStorage.getItem('app_popup_closed') === '1';

    if (!popup || alreadyClosed) return;

    // Show after 20 seconds (20000 ms)
    setTimeout(function () {
        // Just in case user navigated away quickly
        if (!localStorage.getItem('app_popup_closed')) {
            popup.style.display = 'flex';
        }
    }, 3000);

    // Close handlers
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            popup.style.display = 'none';
            localStorage.setItem('app_popup_closed', '1');
        });
    }

    // Optional: close when clicking outside card
    popup.addEventListener('click', function (e) {
        if (e.target === popup) {
            popup.style.display = 'none';
            localStorage.setItem('app_popup_closed', '1');
        }
    });
});
</script>



</body><!-- End of .page_wrapper -->
</html>

