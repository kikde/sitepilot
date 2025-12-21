<!-- President Message Start -->
</br>
<section class="about-section">
    <div class="auto-container">
        <div class="row clearfix align-items-center">

            <!-- Message (text block) -->
            <div class="col-lg-6 col-md-12 col-sm-12 content-column order-2 order-lg-1">
                <div class="content_block_1">
                    <div class="content-box">
                        <div class="sec-title text-left">
                            <h6>Message</h6>
                            @if(!empty($dmessage->name))
                              <h2>{{ $dmessage->name }}</h2>
                            @endif

                            <!-- Photo shown ONLY on mobile inside heading -->
                            <div class="d-block d-lg-none my-3 text-center">
                                <img
                                    @if(!empty($dmessage->breadcrumb))
                                      src="{{ asset('backend/uploads/'.$dmessage->breadcrumb) }}"
                                    @else
                                      src="{{ asset('backend/uploads/placeholder.jpg') }}"
                                    @endif
                                    alt="President Photo"
                                    class="img-fluid rounded shadow"
                                    style="">
                            </div>
                        </div>

                        <div class="text">
                            <p>
                              {!! $dmessage->description ?? '' !!}
                            </p>
                                                 </div>

                        <!-- Signature Section -->
                        <div class="signature-box">
                            @if(!empty($dmessage->image))
                              <img src="{{ asset('backend/uploads/'.$dmessage->image) }}" alt="Signature" class="img-fluid mb-2" style="max-width:180px;">
                            @endif
                            <p><strong><h2>Director,</h2> <div class="fw-bold lh-sm">{{$setting->title}}</div>
                                </strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photo (desktop right) -->
            <div class="col-lg-6 col-md-12 col-sm-12 image-column order-1 order-lg-2 d-none d-lg-block">
                <div class="image_block_1">
                    <div class="image-box text-center">
                        <figure class="image m-0">
                            <img
                                @if(!empty($dmessage->breadcrumb))
                                  src="{{ asset('backend/uploads/'.$dmessage->breadcrumb) }}"
                                @endif
                                alt="President Photo"
                                class="img-fluid rounded shadow">
                        </figure>
                    </div>
                </div>
            </div>

        </div>
    </div>

 
</section>

<!-- President Message End -->
