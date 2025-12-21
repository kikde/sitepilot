
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Payment Receipt</title><style>@font-face{font-family:"Roca One Light";src:url("{{asset('frontend/custom/fonts/RocaOneLight.woff2')}}") format("woff2");font-weight:300;font-style:italic;font-display:swap}
@font-face{font-family:"Roca One Lt";src:url("{{asset('frontend/custom/fonts/RocaOneLt.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"Roca One Bold";src:url("{{asset('frontend/custom/fonts/RocaOneBold.woff2')}}") format("woff2");font-weight:700;font-style:normal;font-display:swap}
@font-face{font-family:"Lato Black";src:url("{{asset('frontend/custom/fonts/LatoBlack.woff2')}}") format("woff2");font-weight:900;font-style:normal;font-display:swap}</style><style>
    @page { size: 214mm 148.93mm; margin: 0; }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: #091225;
      color: #0b0d13;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
    #page {
      position: relative;
      width: 808.82px;
      height: 562.89px;
      background: #fff;
      overflow: hidden;
      transform-origin: top center;
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
      border-radius: 4px;
    }
    #bg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
    .item {
      position: absolute;
      transform-origin: top left;
    }
    @media print {
      body { background: #fff; padding: 0; }
      #page { box-shadow: none; transform: none !important; }
    }
  </style></head><body><div id="page"><!-- Layers -->  <!-- BEGIN: Layer 01: blue-line1 (image) -->
  <div id="blue-line1" class="item item--image item--blue-line1 item--mask-none" data-type="image" data-name="blue-line1" data-z="1" data-source-id="blue-line1" data-locked="0" data-group="" data-mask="none" data-laravel="false" style="left:54.30px;top:100.43px;width:687px;height:81px;transform:rotate(0deg);z-index:1;"><img src="{{asset('frontend/custom/card/dline-01.png')}}" alt="" data-src-placeholder="true" data-source-id="blue-line1" data-asset-src="assets/image-01.png" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 01: blue-line1 (image) -->
  <!-- BEGIN: Layer 02: bglogo (image) -->
  <div id="bglogo" class="item item--image item--bglogo item--mask-none" data-type="image" data-name="bglogo" data-z="1" data-source-id="bglogo" data-locked="0" data-group="" data-mask="none" data-laravel="true" data-laravel-value="{{asset('backend/uploads/'.$setting->site_logo)}}" style="left:288.96px;top:172.29px;width:227px;height:228px;transform:rotate(0deg);z-index:1;opacity:0.09;"><img src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 02: bglogo (image) -->
  <!-- BEGIN: Layer 03: fram (image) -->
  <div id="fram" class="item item--image item--fram item--mask-none" data-type="image" data-name="fram" data-z="1" data-source-id="fram" data-locked="0" data-group="" data-mask="none" data-laravel="false" style="left:14.55px;top:5.59px;width:775px;height:549px;transform:rotate(0deg);z-index:1;"><img src="{{asset('frontend/custom/card/dfram-02.png')}}" alt="" data-src-placeholder="true" data-source-id="fram" data-asset-src="assets/image-03.png" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 03: fram (image) -->
  <!-- BEGIN: Layer 04: cadress (text) -->
  <div id="cadress" class="item item--text item--cadress" data-type="text" data-name="cadress" data-merge="Corp. Office: Motihari,East champaran (Bihar) Pin- 845401 New Delhi - 110001 Ph:9852525297 Email: royal.dhillon83@gmail.com" data-z="5" data-source-id="cadress" data-locked="0" data-group="" data-mask="none" data-laravel="true" data-laravel-value="{{ $setting->address }}" data-case="original" data-font-family="Roca One Light" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneLight.woff2')}}" style="left:180.30px;top:72.29px;width:524px;height:31px;transform:rotate(0deg);z-index:5;clip-path:inset(0px);font-family:&quot;Roca One Light&quot;;font-size:13px;font-weight:400;font-style:normal;color:rgb(35, 13, 177);text-align:center;line-height:15.6px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{ $setting->address }}</div>
  <!-- END: Layer 04: cadress (text) -->
  <!-- BEGIN: Layer 05: image-divider (image) -->
  <div id="image-divider" class="item item--image item--image-divider item--mask-none" data-type="image" data-name="image-divider" data-z="6" data-source-id="image-divider" data-locked="0" data-group="" data-mask="none" data-laravel="false" style="left:250.18px;top:101.47px;width:345px;height:29px;transform:rotate(0deg);z-index:6;"><img src="{{asset('frontend/custom/card/dredline-03.png')}}" alt="" data-src-placeholder="true" data-source-id="image-divider" data-asset-src="assets/image-05.png" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 05: image-divider (image) -->
  <!-- BEGIN: Layer 06: logo (image) -->
  <div id="logo" class="item item--image item--logo item--mask-none" data-type="image" data-name="logo" data-z="7" data-source-id="logo" data-locked="0" data-group="" data-mask="none" data-laravel="true" data-laravel-value="{{asset('backend/uploads/'.$setting->site_logo)}}" style="left:70.18px;top:35.18px;width:86px;height:86px;transform:rotate(0deg);z-index:7;"><img src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 06: logo (image) -->
  <!-- BEGIN: Layer 07: forcompany (text) -->
  <div id="forcompany" class="item item--text item--forcompany" data-type="text" data-name="forcompany" data-merge="For SATHYA CHARITABLE TRUST" data-z="9" data-source-id="forcompany" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Lt" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneLt.woff2')}}" style="left:487.73px;top:404.70px;width:448px;height:18px;transform:rotate(0deg);z-index:9;clip-path:inset(0px);font-family:&quot;Roca One Lt&quot;;font-size:14.8px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:17.76px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;"><span style="color: rgba(24,0,173,var(--O42jJQ,1)); font-weight: 700">  </span><span style="color: rgba(24,0,173,var(--O42jJQ,1)); font-weight: 700">For {{ $setting->title }}</span><span style="color: rgba(24,0,173,var(--O42jJQ,1)); font-weight: 700"> </span></div>
  <!-- END: Layer 07: forcompany (text) -->
  <!-- BEGIN: Layer 08: pan-no (text) -->
  <div id="pan-no" class="item item--text item--pan-no" data-type="text" data-name="pan-no" data-merge="PAN NO: DCUPS00495" data-z="10" data-source-id="pan-no" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Bold" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneBold.woff2')}}" style="left:568.05px;top:134.24px;width:78px;height:19px;transform:rotate(0deg);z-index:10;clip-path:inset(0px);font-family:&quot;Roca One Bold&quot;;font-size:16px;font-weight:400;font-style:normal;color:rgb(248, 8, 8);text-align:left;line-height:19.2px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">PAN NO: </div>
  <!-- END: Layer 08: pan-no (text) -->
  <!-- BEGIN: Layer 09: regdnotitle (text) -->
  <div id="regdnotitle" class="item item--text item--regdnotitle" data-type="text" data-name="regdnotitle" data-merge="REGD NO" data-z="12" data-source-id="regdnotitle" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Bold" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneBold.woff2')}}" style="left:55.45px;top:135.22px;width:235px;height:19px;transform:rotate(0deg);z-index:12;clip-path:inset(0px);font-family:&quot;Roca One Bold&quot;;font-size:16px;font-weight:400;font-style:normal;color:rgb(248, 7, 7);text-align:left;line-height:19.2px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">REGD NO: </div>
  <!-- END: Layer 09: regdnotitle (text) -->
  <!-- BEGIN: Layer 10: cregdno (text) -->
  <div id="cregdno" class="item item--text item--cregdno" data-type="text" data-name="cregdno" data-merge="REGD NO:" data-z="13" data-source-id="cregdno" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Bold" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneBold.woff2')}}" style="left:140.84px;top:135.55px;width:235px;height:19px;transform:rotate(0deg);z-index:13;clip-path:inset(0px);font-family:&quot;Roca One Bold&quot;;font-size:16px;font-weight:400;font-style:normal;color:rgb(25, 1, 173);text-align:left;line-height:19.2px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$payrec->regno}} </div>
  <!-- END: Layer 10: cregdno (text) -->
  <!-- BEGIN: Layer 11: text-pan-no (text) -->
  <div id="text-pan-no" class="item item--text item--text-pan-no" data-type="text" data-name="text-pan-no" data-merge="DCUPS00495" data-z="14" data-source-id="text-pan-no" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Bold" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneBold.woff2')}}" style="left:636.23px;top:135.28px;width:134px;height:19px;transform:rotate(0deg);z-index:14;clip-path:inset(0px);font-family:&quot;Roca One Bold&quot;;font-size:16px;font-weight:400;font-style:normal;color:rgb(26, 2, 174);text-align:left;line-height:19.2px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$payrec->id_no}}</div>
  <!-- END: Layer 11: text-pan-no (text) -->
  <!-- BEGIN: Layer 12: img-zd6qj9 (image) -->
  <div id="img-zd6qj9" class="item item--image item--img-zd6qj9 item--mask-none" data-type="image" data-name="img-zd6qj9" data-z="16" data-source-id="img-zd6qj9" data-locked="0" data-group="" data-mask="none" data-laravel="false" style="left:-514.02px;top:-109.61px;width:756px;height:89px;transform:rotate(0deg);z-index:16;"><img src="{{asset('frontend/custom/card/dline-01.png')}} " alt="" data-src-placeholder="true" data-source-id="img-zd6qj9" data-asset-src="assets/image-01.png" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 12: img-zd6qj9 (image) -->
  <!-- BEGIN: Layer 13: blue-line2 (image) -->
  <div id="blue-line2" class="item item--image item--blue-line2 item--mask-none" data-type="image" data-name="blue-line2" data-z="18" data-source-id="blue-line2" data-locked="0" data-group="" data-mask="none" data-laravel="false" style="left:55.44px;top:159.39px;width:687px;height:81px;transform:rotate(0deg);z-index:18;"><img src="{{asset('frontend/custom/card/dline-01.png')}} " alt="" data-src-placeholder="true" data-source-id="blue-line2" data-asset-src="assets/image-01.png" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 13: blue-line2 (image) -->
  <!-- BEGIN: Layer 14: paragraph-detail (text) -->
  <div id="paragraph-detail" class="item item--text item--paragraph-detail" data-type="text" data-name="paragraph-detail" data-merge="An Organization committed to provide lifelong care for Special need children/Adults by Constructing and running of Homes for Autism Children and Autism Adults and their Parents and running of Special Schools, Vocational Training Centers for Special need children, special need Adults and free medical care" data-z="20" data-source-id="paragraph-detail" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Lt" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneLt.woff2')}}" style="left:56.11px;top:159.41px;width:687px;height:51px;transform:rotate(0deg);z-index:20;clip-path:inset(0px);font-family:&quot;Roca One Lt&quot;;font-size:14.21px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:justify;line-height:17.052px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;"><span style="color: rgba(178,32,9,var(--O42jJQ,1))">An Organization committed to provide lifelong care for Special need children/Adults by Constructing and running of Homes for Autism Children and Autism Adults and their Parents and running of Special Schools, Vocational Training Centers for Special need children, special need Adults and free medical care</span><span style="color: rgba(178,32,9,var(--O42jJQ,1))"> </span></div>
  <!-- END: Layer 14: paragraph-detail (text) -->
  <!-- BEGIN: Layer 15: Date (text) -->
  <div id="Date" class="item item--text item--date" data-type="text" data-name="Date" data-merge="DATE:" data-z="25" data-source-id="Date" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Lato Black" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/LatoBlack.woff2')}}" style="left:580.27px;top:227.83px;width:160px;height:24px;transform:rotate(0deg);z-index:25;clip-path:inset(0px);font-family:&quot;Lato Black&quot;;font-size:18px;font-weight:600;font-style:normal;color:rgb(248, 7, 7);text-align:left;line-height:24px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">DATE:{{$payrec->created_at?->format('d-m-Y')}}</div>
  <!-- END: Layer 15: Date (text) -->
  <!-- BEGIN: Layer 16: sno-title (text) -->
  <div id="sno-title" class="item item--text item--sno-title" data-type="text" data-name="sno-title" data-merge="S.No:" data-z="26" data-source-id="sno-title" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Lato Black" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/LatoBlack.woff2')}}" style="left:57.84px;top:224.51px;width:160px;height:26px;transform:rotate(0deg);z-index:26;clip-path:inset(0px);font-family:&quot;Lato Black&quot;;font-size:22px;font-weight:600;font-style:normal;color:rgb(248, 7, 7);text-align:left;line-height:26.4px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">S.No: {{$payrec->id}}</div>
  <!-- END: Layer 16: sno-title (text) -->
  <!-- BEGIN: Layer 17: donation (text) -->
  <div id="donation" class="item item--text item--donation" data-type="text" data-name="donation" data-merge="DONATION RECEIPT" data-z="28" data-source-id="donation" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Lt" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneLt.woff2')}}" style="left:277.83px;top:226.72px;width:283px;height:30px;transform:rotate(0deg);z-index:28;clip-path:inset(0px);font-family:&quot;Roca One Lt&quot;;font-size:24.6px;font-weight:600;font-style:normal;color:rgb(179, 32, 10);text-align:left;line-height:29.52px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">DONATION RECEIPT</div>
  <!-- END: Layer 17: donation (text) -->
  <!-- BEGIN: Layer 18: dividerblue (image) -->
  <div id="dividerblue" class="item item--image item--dividerblue item--mask-none" data-type="image" data-name="dividerblue" data-z="30" data-source-id="dividerblue" data-locked="0" data-group="" data-mask="none" data-laravel="false" style="left:284.09px;top:242.98px;width:227px;height:34px;transform:rotate(0deg);z-index:30;"><img src="{{asset('frontend/custom/card/dblueline-04.png')}}" alt="" data-src-placeholder="true" data-source-id="dividerblue" data-asset-src="assets/image-18.png" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 18: dividerblue (image) -->
  <!-- BEGIN: Layer 19: trusteefooter (text) -->
  <div id="trusteefooter" class="item item--text item--trusteefooter" data-type="text" data-name="trusteefooter" data-merge="Managing Trustee / Secretary" data-z="32" data-source-id="trusteefooter" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Lt" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneLt.woff2')}}" style="left:491.91px;top:455.27px;width:448px;height:19px;transform:rotate(0deg);z-index:32;clip-path:inset(0px);font-family:&quot;Roca One Lt&quot;;font-size:15.5px;font-weight:600;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:18.6px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;"><span style="color: rgba(24,0,173,var(--O42jJQ,1))"> </span><span style="color: rgba(24,0,173,var(--O42jJQ,1))">Managing Trustee / Secretary</span></div>
  <!-- END: Layer 19: trusteefooter (text) -->
  <!-- BEGIN: Layer 20: footer-line (text) -->
  <div id="footer-line" class="item item--text item--footer-line" data-type="text" data-name="footer-line" data-merge="Donation are exempted u/s 80G of the I.T.Act, 1961, Vide The D.I.T (Exemption ) Regd No. AADTM Memo No: 123" data-z="33" data-source-id="footer-line" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Lt" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneLt.woff2')}}" style="left:116.64px;top:490.83px;width:568px;height:13px;transform:rotate(0deg);z-index:33;clip-path:inset(0px);font-family:&quot;Roca One Lt&quot;;font-size:11.1px;font-weight:600;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:13.32px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;"><span style="color: rgba(0,0,0,var(--O42jJQ,1)); font-weight: 400">Donation are exempted u/s 80G of the I.T.Act, 1961, Vide The D.I.T (Exemption ) Regd No. AADTM Memo No: 123</span></div>
  <!-- END: Layer 20: footer-line (text) -->
  <!-- BEGIN: Layer 21: cname (text) -->
  <div id="cname" class="item item--text item--cname" data-type="text" data-name="cname" data-merge="MIRA EDUCATIONA AND WELFARE TRUST:" data-z="34" data-source-id="cname" data-locked="0" data-group="" data-mask="none" data-laravel="true" data-laravel-value="{{ $setting->title }}" data-case="original" data-font-family="Roca One Bold" data-font-weight="700" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneBold.woff2')}}" style="left:170.64px;top:48.60px;width:547px;height:31px;transform:rotate(0deg);z-index:34;clip-path:inset(0px);font-family:&quot;Roca One Bold&quot;;font-size:26px;font-weight:700;font-style:normal;color:rgb(248, 7, 7);text-align:left;line-height:31.2px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{ $setting->title }}</div>
  <!-- END: Layer 21: cname (text) -->
  <!-- BEGIN: Layer 22: imageofrs (image) -->
  <div id="imageofrs" class="item item--image item--imageofrs item--mask-none" data-type="image" data-name="imageofrs" data-z="35" data-source-id="imageofrs" data-locked="0" data-group="" data-mask="none" data-laravel="false" style="left:58.59px;top:413.47px;width:258px;height:63px;transform:rotate(0deg);z-index:35;"><img src="{{asset('frontend/custom/card/dpay-05.png')}}" alt="" data-src-placeholder="true" data-source-id="imageofrs" data-asset-src="assets/image-22.png" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 22: imageofrs (image) -->
  <!-- BEGIN: Layer 23: paragah (text) -->
  <div id="paragah" class="item item--text item--paragah" data-type="text" data-name="paragah" data-merge="name" data-z="36" data-source-id="paragah" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roca One Lt" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/RocaOneLt.woff2')}}" style="left:59.13px;top:271.38px;width:691px;height:22px;transform:rotate(0deg);z-index:36;clip-path:inset(0px);font-family:&quot;Roca One Lt&quot;;font-size:18px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:21.6px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$payrec->name}}</div>
  <!-- END: Layer 23: paragah (text) -->
  <!-- BEGIN: Layer 24: payment (text) -->
  <div id="payment" class="item item--text item--payment" data-type="text" data-name="payment" data-merge="9999999999" data-z="38" data-source-id="payment" data-locked="0" data-group="" data-mask="none" data-laravel="false" data-case="original" data-font-family="Lato Black" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/LatoBlack.woff2')}}" style="left:130.06px;top:427.84px;width:160px;height:31px;transform:rotate(0deg);z-index:38;clip-path:inset(0px);font-family:&quot;Lato Black&quot;;font-size:26px;font-weight:600;font-style:normal;color:rgb(248, 7, 7);text-align:left;line-height:31.2px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$payrec->amount}}</div>
  <!-- END: Layer 24: payment (text) -->
  <!-- BEGIN: Layer 25: stamp (image) -->
  <div id="stamp" class="item item--image item--stamp item--mask-none" data-type="image" data-name="stamp" data-z="39" data-source-id="stamp" data-locked="0" data-group="" data-mask="none" data-laravel="true" data-laravel-value="{{asset('backend/uploads/'.$setting->company_stamp)}}" style="left:404.52px;top:401.18px;width:113px;height:78px;transform:rotate(0deg);z-index:39;"><img src="{{asset('backend/uploads/'.$setting->company_stamp)}}" alt="" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 25: stamp (image) -->
  <!-- BEGIN: Layer 26: sign (image) -->
  <div id="sign" class="item item--image item--sign item--mask-none" data-type="image" data-name="sign" data-z="41" data-source-id="sign" data-locked="0" data-group="" data-mask="none" data-laravel="true" data-laravel-value="{{asset('backend/uploads/'.$stampsign->image)}}" style="left:513.40px;top:381.18px;width:227px;height:91px;transform:rotate(0deg);z-index:41;"><img src="{{asset('backend/uploads/'.$stampsign->image)}}" alt="" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 26: sign (image) --></div><script>(() => {
    const page = document.getElementById('page');
    if (!page) return;
    const fit = () => {
      const margin = 24;
      const scaleX = (window.innerWidth - margin * 2) / page.offsetWidth;
      const scaleY = (window.innerHeight - margin * 2) / page.offsetHeight;
      const scale = Math.max(Math.min(scaleX, scaleY), 0.1);
      page.style.transform = 'scale(' + scale.toFixed(4) + ')';
    };
    window.addEventListener('resize', fit);
    window.addEventListener('orientationchange', fit);
    window.addEventListener('load', fit);
    fit();
  })();</script></body></html>