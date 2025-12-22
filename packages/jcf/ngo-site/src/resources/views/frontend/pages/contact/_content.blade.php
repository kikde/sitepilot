
<!-- Page Title -->
<section class="page-title contact-page style-two centred" style="background-image: url({{asset('frontend/assets/images/background/contact.png')}});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>Contact</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- contact-info-section -->
<section class="contact-info-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                    <div class="single-info-box">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-location"></i></div>
                            <h6>Location</h6>
                            <p>{{$setting->address}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                    <div class="single-info-box">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-phone-call"></i></div>
                            <h6>Quick Contact</h6>
                            <p> Phone : <a href="tel:{!!$setting->phone!!}">{!!$setting->phone!!}</a><br />
                                Email : <a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                    <div class="single-info-box">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-email"></i></div>
                            <h6>Support</h6>
                            <p>{{$setting->site_email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-info-section end -->

<!-- contact-section -->
<section class="contact-section">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                <div class="form-inner">
                    <div class="sec-title">
                        <h6>Drop Us Line</h6>
                        <h2>Send Your Message</h2>
                    </div>
                    <form action="{{url('/send-mail')}}" method="post" class="default-form">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="name" placeholder="Your Name *" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="email" name="email" placeholder="Email Address *" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="phone" placeholder="Phone *" required="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="subject" placeholder="Subject *" required="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <textarea name="message" placeholder="Message ..."></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                <button class="theme-btn-two" type="submit" name="submit-form">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-section end -->

@php
    // Prefer map embed set from backend settings; accept either a full <iframe> or an embed URL.
    $mapEmbed = $setting->map_embed ?? null;
    $defaultMap = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7310.971940464816!2d72.93813414488372!3d23.62276119485529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395db974f9b87997%3A0xb9755180e2423c17!2sHimatnagar%20sabarkantha!5e0!3m2!1sen!2sin!4v1763709685119!5m2!1sen!2sin';
@endphp

<!-- google-map-section -->
<section class="google-map-section">
    <div class="map-inner">
        <div class="google-map">
            @php $hasIframe = is_string($mapEmbed) && stripos($mapEmbed, '<iframe') !== false; @endphp
            @if($hasIframe)
                {!! $mapEmbed !!}
            @else
                <iframe src="{{ $mapEmbed ?: $defaultMap }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @endif
        </div>
    </div>
</section>
<!-- google-map-section end -->
