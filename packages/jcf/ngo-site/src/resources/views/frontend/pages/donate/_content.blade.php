<!-- Page Title -->
<section class="page-title style-two centred" style="background-image: url({{ asset('frontend/assets/images/background/donation.png') }});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>Donate Now</h1>
            </div>
            <ul class="bread-crumb clearfix">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>Donations</li>
                <li></li>
            </ul>
        </div>
    </div>
</section>

<section class="checkout-page-section">
    <div class="auto-container">
        <div class="order-information">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 left-column">
                    <div class="information-inner">
                        <div class="shopping-address">
                            <h3 style="color: #0a267a !important">Donate Directly to the Foundation Online</h3>
                                <form class="auth-register-form mt-2" action="{{ route('ngo.donate.start') }}"
                                      method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="text" name="name" placeholder="Name" required="">
                                </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="email" name="email" placeholder="Email" required="">
                                </div>
                               </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="text" name="mobile" inputmode="numeric" pattern="[6-9][0-9]{9}" maxlength="10" placeholder="10-digit mobile" required>
                                </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="field-input" id="don-state-field">
                                        <select name="state" id="don-state" style="display:none;">
                                            <option value="">Select State</option>
                                            @foreach($getlist as $key=>$value)
                                              <option value="{{$key}}" @selected(old('state')===$key)>{{$key}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="city" placeholder="City" required="">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="text" name="address" placeholder="Address" required="">
                                </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="text" name="pincode" placeholder="Pincode" required="">
                                </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="text" name="pan_no" placeholder="PAN No." required="">
                                </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="number" name="amount" placeholder="Amount" required="">
                                </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="field-input">
                                        <button type="submit" class="theme-btn-two">Proceed to Pay</button>
                                    </div>
                                    <span class="description">You agree that {{$setting->title}} can reach out to you through Whatsapp/email/SMS/Phone to provide information of your donation etc.</span>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
