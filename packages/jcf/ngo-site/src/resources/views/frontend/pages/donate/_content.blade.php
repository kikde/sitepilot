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

<!-- checkout-page-section -->
<section class="checkout-page-section">
    <div class="auto-container">
        <div class="order-information">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 left-column">
                    <div class="information-inner">
                        <div class="shopping-address">
                            <h3 style="color: #0a267a !important">Donate Directly to the Foundation Online</h3>
                                @php
    $donateAction = null;
    if (\Illuminate\Support\Facades\Route::has('donate.start')) {
        $donateAction = route('donate.start');
    } elseif (\Illuminate\Support\Facades\Route::has('ngo.donate.start')) {
        $donateAction = route('ngo.donate.start');
    } elseif (\Illuminate\Support\Facades\Route::has('donate.autopay.start')) {
        $donateAction = route('donate.autopay.start');
    } else {
        $donateAction = url('/donate/start');
    }
@endphp
<form class="auth-register-form mt-2" action="{{ $donateAction }}"
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
                                    
                                        <!-- Real select kept for submission (hidden visually) -->
                                        <select name="state" id="don-state" style="display:none;">
                                            <option value="">Select State</option>
                                            @foreach($getlist as $key=>$value)
                                              <option value="{{$key}}" @selected(old('state')===$key)>{{$key}}</option>
                                            @endforeach
                                        </select>

                                        <!-- Custom searchable select widget (single search input inside dropdown) -->
                                        <div id="don-state-custom" class="mr-select-search">
                                            <div class="mr-select-display">Select State</div>
                                            <div class="mr-select-dropdown">
                                                <input type="text" class="mr-select-input" placeholder="Search state...">
                                                <div class="mr-select-options"></div>
                                            </div>
                                        </div>

                                        </div>

                                        <!-- Custom searchable select widget (single search input inside dropdown) -->
                                        <div id="don-state-custom" class="mr-select-search">
                                            <div class="mr-select-display">Select State</div>
                                            <div class="mr-select-dropdown">
                                                <input type="text" class="mr-select-input" placeholder="Search state...">
                                                <div class="mr-select-options"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="city" placeholder="City" required="">
                                        {{-- <select class="wide" id="city">
                                            <option data-display="Select City">Select City</option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="address" placeholder="Address" required="">
                                        
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="pincode" placeholder="Pin Code" required="">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="field-input">
                                        <input type="text" name="pan_no" placeholder="Pan No.*" required="">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-6 col-sm-12 column">
                                <div class="field-input">
                                    <input type="text" name="amount" inputmode="decimal" pattern="^[0-9]+(\.[0-9]{1,2})?$" placeholder="Amount" required>
                                </div>
                                </div>
                            </div>
                            <div class="field-input">
                                <div class="custom-controls-stacked">
                                    <label class="custom-control material-checkbox">
                                        <input type="checkbox" class="material-control-input">
                                        <span class="material-control-indicator"></span>
                                        <span class="description">You agree that {{$setting->title}} can reach out to you through Whatsapp/email/SMS/Phone to provide information of your donation etc.</span>
                                    </label>
                                </div>
                            </div>
                          
                        </div>
                        
                    </div>
                    <div class="btn-box text-center">
                            <button type="submit" class="theme-btn-four thm-btn" tabindex="5">Pay Now</button>
                            
                        </div>
                        <br>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 right-column">
                    <div class="order-summary">
                        <h4>Quick Donation - Just Scan</h4>
                        <div class="inner-box">
                            @php
    $donateAction = null;
    if (\Illuminate\Support\Facades\Route::has('donate.start')) {
        $donateAction = route('donate.start');
    } elseif (\Illuminate\Support\Facades\Route::has('ngo.donate.start')) {
        $donateAction = route('ngo.donate.start');
    } elseif (\Illuminate\Support\Facades\Route::has('donate.autopay.start')) {
        $donateAction = route('donate.autopay.start');
    } else {
        $donateAction = url('/donate/start');
    }
@endphp
                            @if($qrSrc && $isImage)
                              <figure class="image-box"><img src="{{ $qrSrc }}" alt="Donation QR"></figure>
                            @elseif($qrSrc)
                              <div class="p-1" style="border:1px dashed #e5e7eb; border-radius:10px; background:#fafafa;">
                                <p class="mb-50" style="font-weight:600;">QR file uploaded</p>
                                <a href="{{ $qrSrc }}" target="_blank" class="theme-btn-four thm-btn">Open File</a>
                              </div>
                            @else
                              <figure class="image-box"><img src="{{asset('frontend/custom/payment-Qrcode.png')}}" alt="Donation QR"></figure>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
        
         @include ("frontend.partials.donate.style-22")
     
       @include ("frontend.partials.donor.style-1")
    </div>
</section>
<!-- checkout-page-section end -->






<style>
/* ==== Donate form: custom searchable State dropdown (same as member registration) ==== */
#don-state-custom{ position:relative; font-size:15px; width:100%; }
.mr-select-display{ border-radius:12px; border:1.5px solid #e5e7eb; background:#ffffff; cursor:pointer; height:40px; padding:0 12px; display:flex; align-items:center; }
.mr-select-dropdown{ position:absolute; left:0; right:0; top:0; background:#ffffff; border-radius:12px; border:1.5px solid #e5e7eb; box-shadow:0 10px 24px rgba(15,23,42,.18); z-index:999; display:none; }
.mr-select-search.is-open .mr-select-display{ display:none; }
.mr-select-search.is-open .mr-select-dropdown{ display:block; }
.mr-select-input{ width:100%; border:none; border-bottom:1px solid #e5e7eb; padding:8px 10px; outline:none; font-size:14px; border-radius:12px 12px 0 0; }
.mr-select-options{ max-height:220px; overflow-y:auto; }
.mr-select-option{ padding:7px 10px; cursor:pointer; font-size:14px; }
.mr-select-option:hover, .mr-select-option.is-active{ background:#6366f1; color:#ffffff; }

/* Hide any third‑party enhanced select UI generated for #don-state (e.g., Nice Select / Select2) */
#don-state + .nice-select,
#don-state + .select2,
#don-state + .select2-container,
#don-state ~ .nice-select,
#don-state ~ .select2,
#don-state ~ .select2-container,
#don-state-field .nice-select,
#don-state-field .select2,
#don-state-field .select2-container,
#don-state-field .custom-select,
#don-state-field .choices,
#don-state-field .selectpicker{
  display:none !important;
}
/* Ensure tel matches other inputs */
.field-input input[type=tel]{ background:#f3f5f9; border:1px solid #e5e7eb; border-radius:12px; height:42px; }
</style>

<script>
(function () {
    const select  = document.getElementById('don-state');
    const wrapper = document.getElementById('don-state-custom');
    if (!select || !wrapper) return;

    const display  = wrapper.querySelector('.mr-select-display');
    const dropdown = wrapper.querySelector('.mr-select-dropdown');
    const input    = wrapper.querySelector('.mr-select-input');
    const listBox  = wrapper.querySelector('.mr-select-options');

    const items = [];

    // Build list from hidden <select> options
    for (let i = 0; i < select.options.length; i++) {
        const opt = select.options[i];
        if (!opt.value) continue;

        const div = document.createElement('div');
        div.className = 'mr-select-option';
        div.textContent = opt.text;
        div.dataset.value = opt.value;
        listBox.appendChild(div);
        items.push(div);
    }

    function openDropdown() {
        wrapper.classList.add('is-open');
        input.value = '';
        filterOptions('');
        input.focus();
    }

    function closeDropdown() {
        wrapper.classList.remove('is-open');
    }

    function filterOptions(term) {
        const t = term.toLowerCase();
        items.forEach(el => {
            const match = el.textContent.toLowerCase().includes(t);
            el.style.display = match ? 'block' : 'none';
        });
    }

    // Click on display to open/close
    display.addEventListener('click', function (e) {
        e.stopPropagation();
        if (wrapper.classList.contains('is-open')) {
            closeDropdown();
        } else {
            openDropdown();
        }
    });

    // Filter as user types
    input.addEventListener('input', function () {
        filterOptions(this.value);
    });

    // Select option
    listBox.addEventListener('click', function (e) {
        const item = e.target.closest('.mr-select-option');
        if (!item) return;

        select.value = item.dataset.value;      // update real select
        display.textContent = item.textContent; // show selected text

        closeDropdown();
    });

    // Close when clicking outside
    document.addEventListener('click', function (e) {
        if (!wrapper.contains(e.target)) {
            closeDropdown();
        }
    });

    // On load, if a state already selected (old() value), reflect it
    if (select.value) {
        const selectedOpt = select.options[select.selectedIndex];
        if (selectedOpt) {
            display.textContent = selectedOpt.text;
        }
    }
})();
</script>


