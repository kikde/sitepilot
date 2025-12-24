
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Certificate Export</title><style>@font-face{font-family:"Roboto";src:url("{{asset('frontend/custom/fonts/Roboto.woff2')}}") format("woff2");font-weight:600;font-style:normal;font-display:swap}
@font-face{font-family:"LeagueSpartan";src:url("{{asset('frontend/custom/fonts/LeagueSpartan.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"GlacialIndifference";src:url("{{asset('frontend/custom/fonts/GlacialIndifference.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"ArchivoBlack";src:url("{{asset('frontend/custom/fonts/ArchivoBlack.woff2')}}") format("woff2");font-weight:900;font-style:normal;font-display:swap}
@font-face{font-family:"PoppinsBlack";src:url("{{asset('frontend/custom/fonts/PoppinsBlack.woff2')}}") format("woff2");font-weight:900;font-style:normal;font-display:swap}
@font-face{font-family:"Montserrat";src:url("{{asset('frontend/custom/fonts/Montserrat.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
</style>
<style>
@page { size: 210mm 300mm; margin: 0; }
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
      width: 793.70px;
      height: 1133.86px;
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
  </style></head><body><div id="page"><!-- Layers -->  <!-- BEGIN: Layer 01: img-4jzioc (image) -->
  <div id="img-4jzioc" class="item item--image item--img-4jzioc item--mask-none" data-type="image" data-name="img-4jzioc" data-z="1" data-source-id="img-4jzioc" data-mask="none" data-laravel="false" style="left:0.22px;top:-1.01px;width:793px;height:501px;transform:rotate(0deg);z-index:1;"><img src="{{asset('frontend/custom/card/fstyle-1.png')}}" alt="" data-src-placeholder="true" data-source-id="img-4jzioc" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 01: img-4jzioc (image) -->
  <!-- BEGIN: Layer 02: img-vurfzt (image) -->
  <div id="img-vurfzt" class="item item--image item--img-vurfzt item--mask-none" data-type="image" data-name="img-vurfzt" data-z="1" data-source-id="img-vurfzt" data-mask="none" data-laravel="false" style="left:-7.18px;top:544.18px;width:805px;height:508px;transform:rotate(0deg);z-index:1;"><img src="{{asset('frontend/custom/card/bstyle-1.png')}}" alt="" data-src-placeholder="true" data-source-id="img-vurfzt" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 02: img-vurfzt (image) -->
  <!-- BEGIN: Layer 03: iso (text) -->
  <div id="iso" class="item item--text item--iso" data-type="text" data-name="iso" data-merge="AN ISO 9001:2015 CERTIFIED ORGANISATION" data-z="2" data-source-id="iso" data-mask="none" data-laravel="false" data-case="upper" data-font-family="Roboto" data-font-weight="700" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Roboto.woff2')}}" style="left:178.84px;top:24.29px;width:537px;height:23px;transform:rotate(0deg);z-index:2;clip-path:inset(0px);font-family:Roboto;font-size:19.5px;font-weight:700;font-style:normal;color:rgb(25, 1, 173);text-align:center;line-height:23.4px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">AN ISO 9001:2015 CERTIFIED ORGANISATION</div>
  <!-- END: Layer 03: iso (text) -->
  <!-- BEGIN: Layer 04: company-name (text) -->
  <div id="company-name" class="item item--text item--company-name" data-type="text" data-name="company-name" data-merge="MIRA EDUCATIONAL &amp; WELFARE TRUST" data-z="3" data-source-id="company-name" data-mask="none" data-laravel="true" data-laravel-value="{{ $setting->title }}" data-case="upper" data-font-family="LeagueSpartan" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/LeagueSpartan.woff2')}}" style="left:175.15px;top:50.66px;width:568px;height:34px;transform:rotate(0deg);z-index:3;clip-path:inset(0px);font-family:LeagueSpartan;font-size:28px;font-weight:400;font-style:normal;color:rgb(246, 170, 21);text-align:center;line-height:33.6px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{ $setting->title }}</div>
  <!-- END: Layer 04: company-name (text) -->
  <!-- BEGIN: Layer 05: address (text) -->
  <div id="address" class="item item--text item--address" data-type="text" data-name="address" data-merge="ADRESS: MOTIHARI, EAST CHAMPARAN (BIHAR)- PIN- 845401" data-z="4" data-source-id="address" data-mask="none" data-laravel="true" data-laravel-value="{ $setting->address }}" data-case="upper" data-font-family="Roboto" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Roboto.woff2')}}" style="left:180.66px;top:79.46px;width:550px;height:16px;transform:rotate(0deg);z-index:4;clip-path:inset(0px);font-family:Roboto;font-size:13px;font-weight:600;font-style:normal;color:rgb(25, 1, 173);text-align:center;line-height:15.6px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$setting->address}}</div>
  <!-- END: Layer 05: address (text) -->
  <!-- BEGIN: Layer 06: sname (text) -->
  <div id="sname" class="item item--text item--sname" data-type="text" data-name="sname" data-merge="NAME" data-z="6" data-source-id="sname" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roboto" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Roboto.woff2')}}" style="left:55.81px;top:211.50px;width:150px;height:23px;transform:rotate(0deg);z-index:6;clip-path:inset(0px);font-family:Roboto;font-size:19px;font-weight:600;font-style:normal;color:rgb(24, 0, 173);text-align:left;line-height:22.8px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">NAME</div>
  <!-- END: Layer 06: sname (text) -->
  <!-- BEGIN: Layer 07: regdno (text) -->
  <div id="regdno" class="item item--text item--regdno" data-type="text" data-name="regdno" data-merge="REGD. NO." data-z="7" data-source-id="regdno" data-mask="none" data-laravel="false" data-case="upper" data-font-family="Roboto" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Roboto.woff2')}}" style="left:53.19px;top:251.37px;width:150px;height:23px;transform:rotate(0deg);z-index:7;clip-path:inset(0px);font-family:Roboto;font-size:19px;font-weight:600;font-style:normal;color:rgb(24, 0, 173);text-align:left;line-height:22.8px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">REGD. NO.</div>
  <!-- END: Layer 07: regdno (text) -->
  <!-- BEGIN: Layer 08: dob (text) -->
  <div id="dob" class="item item--text item--dob" data-type="text" data-name="dob" data-merge="DESIGNATION" data-z="8" data-source-id="dob" data-mask="none" data-laravel="false" data-case="original" data-font-family="Roboto" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Roboto.woff2')}}" style="left:52.39px;top:291.33px;width:150px;height:23px;transform:rotate(0deg);z-index:8;clip-path:inset(0px);font-family:Roboto;font-size:19px;font-weight:600;font-style:normal;color:rgb(24, 0, 173);text-align:left;line-height:22.8px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">DESIGNATION</div>
  <!-- END: Layer 08: dob (text) -->
  <!-- BEGIN: Layer 09: homeadress (text) -->
  <div id="homeadress" class="item item--text item--homeadress" data-type="text" data-name="homeadress" data-merge="home adress" data-z="9" data-source-id="homeadress" data-mask="none" data-laravel="false" data-case="upper" data-font-family="Roboto" data-font-weight="600" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Roboto.woff2')}}" style="left:54.63px;top:332.81px;width:150px;height:23px;transform:rotate(0deg);z-index:9;clip-path:inset(0px);font-family:Roboto, system-ui;font-size:19px;font-weight:600;font-style:normal;color:rgb(24, 0, 173);text-align:left;line-height:22.8px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">HOME ADRESS</div>
  <!-- END: Layer 09: homeadress (text) -->
  <!-- BEGIN: Layer 10: inputname (text) -->
  <div id="inputname" class="item item--text item--inputname" data-type="text" data-name="inputname" data-merge=": GEETA KUMARI" data-z="12" data-source-id="inputname" data-mask="none" data-laravel="true" data-laravel-value="{{ $data->name }}" data-case="original" data-font-family="GlacialIndifference" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/GlacialIndifference.woff2')}}" style="left:218.64px;top:212.07px;width:272px;height:24px;transform:rotate(0deg);z-index:12;clip-path:inset(0px);font-family:GlacialIndifference;font-size:20px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:24px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{ $data->name }}</div>
  <!-- END: Layer 10: inputname (text) -->
  <!-- BEGIN: Layer 11: inputregdno (text) -->
  <div id="inputregdno" class="item item--text item--inputregdno" data-type="text" data-name="inputregdno" data-merge=": GEETA KUMARI" data-z="13" data-source-id="inputregdno" data-mask="none" data-laravel="true" data-laravel-value="{{ $data->regno }}" data-case="original" data-font-family="GlacialIndifference" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/GlacialIndifference.woff2')}}" style="left:219.36px;top:252.79px;width:272px;height:24px;transform:rotate(0deg);z-index:13;clip-path:inset(0px);font-family:GlacialIndifference;font-size:20px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:24px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{ $data->regno }}</div>
  <!-- END: Layer 11: inputregdno (text) -->
  <!-- BEGIN: Layer 12: inputdob (text) -->
  <div id="inputdob" class="item item--text item--inputdob" data-type="text" data-name="inputdob" data-merge="MANAGER" data-z="14" data-source-id="inputdob" data-mask="none" data-laravel="true" data-laravel-value="{{ $data->desg }}" data-case="original" data-font-family="GlacialIndifference" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/GlacialIndifference.woff2')}}" style="left:218.25px;top:292.60px;width:272px;height:24px;transform:rotate(0deg);z-index:14;clip-path:inset(0px);font-family:GlacialIndifference;font-size:20px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:24px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;"> {{ $data->desg }}</div>
  <!-- END: Layer 12: inputdob (text) -->
  <!-- BEGIN: Layer 13: inputadress (text) -->
  <div id="inputadress" class="item item--text item--inputadress" data-type="text" data-name="inputadress" data-merge=": Mr Vinesh Kumar Goel H.No 430 Sec-14 Vasundhara Ghazibad Uttar Pardesh -100091" data-z="15" data-source-id="inputadress" data-mask="none" data-laravel="true" data-laravel-value="{{ $data->address }} {{ $data->city }} {{ $data->state }} {{ $data->pincode }}" data-case="original" data-font-family="GlacialIndifference" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/GlacialIndifference.woff2')}}" style="left:219.88px;top:329.68px;width:311px;height:77px;transform:rotate(0deg);z-index:15;clip-path:inset(0px);font-family:GlacialIndifference;font-size:19.7px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:25.61px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{ $data->address }} {{ $data->city }} {{ $data->state }} {{ $data->pincode }}</div>
  <!-- END: Layer 13: inputadress (text) -->
  <!-- BEGIN: Layer 14: studentidcard (text) -->
  <div id="studentidcard" class="item item--text item--studentidcard" data-type="text" data-name="studentidcard" data-merge="STUDENT ID CARD" data-z="16" data-source-id="studentidcard" data-mask="none" data-laravel="false" data-case="original" data-font-family="ArchivoBlack" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/ArchivoBlack.woff2')}}" style="left:53.19px;top:158.65px;width:568px;height:40px;transform:rotate(0deg);z-index:16;clip-path:inset(0px);font-family:ArchivoBlack;font-size:33px;font-weight:400;font-style:normal;color:rgb(246, 170, 21);text-align:left;line-height:39.6px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">MEMBER ID CARD</div>
  <!-- END: Layer 14: studentidcard (text) -->
  <!-- BEGIN: Layer 15: logo (image) -->
  <div id="logo" class="item item--image item--logo item--mask-none" data-type="image" data-name="logo" data-z="19" data-source-id="logo" data-mask="none" data-laravel="false" style="left:44.82px;top:15.73px;width:130px;height:130px;transform:rotate(0deg);z-index:19;"><img src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" data-src-placeholder="true" data-source-id="logo" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 15: logo (image) -->
  <!-- BEGIN: Layer 16: photo (image) -->
  <div id="photo" class="item item--image item--photo item--mask-rounded" data-type="image" data-name="photo" data-z="20" data-source-id="photo" data-mask="rounded" data-laravel="false" style="left:553.81px;top:166.64px;width:183px;height:188px;transform:rotate(0deg);z-index:20;clip-path:inset(0px round 24px);border-radius:24px;overflow:hidden;"><img src="{{asset('backend/uploads/members/'.$data->profile_image)}}" alt="" data-src-placeholder="true" data-source-id="photo" style="width:100%;height:100%;object-fit:fill;display:block;"></div>
  <!-- END: Layer 16: photo (image) -->
  <!-- BEGIN: Layer 17: stamp (image) -->
  <div id="stamp" class="item item--image item--stamp item--mask-none" data-type="image" data-name="stamp" data-z="21" data-source-id="stamp" data-mask="none" data-laravel="false" style="left:508.96px;top:293.91px;width:172px;height:172px;transform:rotate(0deg);z-index:21;"><img src="{{asset('backend/uploads/'.$setting->company_stamp)}}" alt="" data-src-placeholder="true" data-source-id="stamp" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 17: stamp (image) -->
  <!-- BEGIN: Layer 18: sign (image) -->
  <div id="sign" class="item item--image item--sign item--mask-none" data-type="image" data-name="sign" data-z="22" data-source-id="sign" data-mask="none" data-laravel="false" style="left:582.23px;top:277.90px;width:227px;height:155px;transform:rotate(0deg);z-index:22;"><img src="{{asset('backend/uploads/'.$stampsign->image)}}" alt="" data-src-placeholder="true" data-source-id="sign" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 18: sign (image) -->
  <!-- BEGIN: Layer 19: qrcode (image) -->
  <div id="qrcode" class="item item--image item--qrcode item--mask-none" data-type="image" data-name="qrcode" data-z="23" data-source-id="qrcode" data-mask="none" data-laravel="false" style="left:288.29px;top:111.53px;width:285px;height:41px;transform:rotate(0deg);z-index:23;"><img src="{{asset('frontend/custom/brcode.png')}}" alt="" data-src-placeholder="true" data-source-id="qrcode" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 19: qrcode (image) -->
  <!-- BEGIN: Layer 20: log (image) -->
  <div id="log" class="item item--image item--log item--mask-none" data-type="image" data-name="log" data-z="27" data-source-id="log" data-mask="none" data-laravel="false" style="left:309.93px;top:569.93px;width:165px;height:165px;transform:rotate(0deg);z-index:27;"><img src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" data-src-placeholder="true" data-source-id="log" style="width:100%;height:100%;object-fit:contain;display:block;"></div>
  <!-- END: Layer 20: log (image) -->
  <!-- BEGIN: Layer 21: text-n0yoz2 (text) -->
  <div id="text-n0yoz2" class="item item--text item--text-n0yoz2" data-type="text" data-name="text-n0yoz2" data-merge="TERMS AND CONDITIONS" data-z="28" data-source-id="text-n0yoz2" data-mask="none" data-laravel="false" data-case="original" data-font-family="PoppinsBlack" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/PoppinsBlack.woff2')}}" style="left:147.28px;top:747.83px;width:510px;height:47px;transform:rotate(0deg);z-index:28;clip-path:inset(0px);font-family:PoppinsBlack;font-size:39px;font-weight:400;font-style:normal;color:rgb(24, 0, 173);text-align:left;line-height:46.8px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">TERMS AND CONDITIONS</div>

  <div id="text-uvsekb" class="item item--text item--text-uvsekb" data-type="text" data-name="text-uvsekb" data-merge="This Card is Not Transferable" data-z="32" data-source-id="text-uvsekb" data-mask="none" data-laravel="false" data-case="original" data-font-family="Montserrat" data-font-weight="500" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Montserrat.woff2')}}" style="left:128.11px;top:800.83px;width:302px;height:20px;transform:rotate(0deg);z-index:32;clip-path:inset(0px);font-family:Montserrat;font-size:16.4px;font-weight:500;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:19.68px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">This Card is Not Transferable</div>
  <!-- END: Layer 24: text-uvsekb (text) -->
  <!-- BEGIN: Layer 25: text-cgnguj (text) -->
  <div id="text-cgnguj" class="item item--text item--text-cgnguj" data-type="text" data-name="text-cgnguj" data-merge="Always Carry This Card While in Campus Produce on Demand-Keep it Safe" data-z="33" data-source-id="text-cgnguj" data-mask="none" data-laravel="false" data-case="original" data-font-family="Montserrat" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Montserrat.woff2')}}" style="left:129.51px;top:830.73px;width:667px;height:20px;transform:rotate(0deg);z-index:33;clip-path:inset(0px);font-family:Montserrat;font-size:16.4px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:19.68px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">Always Carry This Card While in Campus Produce on Demand-Keep it Safe </div>
  <!-- END: Layer 25: text-cgnguj (text) -->
  <!-- BEGIN: Layer 26: text-k17vhs (text) -->
  <div id="text-k17vhs" class="item item--text item--text-k17vhs" data-type="text" data-name="text-k17vhs" data-merge="A Duplicate Card will be issued on Payment of Rs. 200," data-z="35" data-source-id="text-k17vhs" data-mask="none" data-laravel="false" data-case="original" data-font-family="Montserrat" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Montserrat.woff2')}}" style="left:129.30px;top:890px;width:551px;height:20px;transform:rotate(0deg);z-index:35;clip-path:inset(0px);font-family:Montserrat;font-size:16.4px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:19.68px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">A Duplicate Card will be issued on Payment of Rs. 200, </div>
  <!-- END: Layer 26: text-k17vhs (text) -->
  <!-- BEGIN: Layer 27: website (text) -->
  <div id="website" class="item item--text item--website" data-type="text" data-name="website" data-merge="www.meeragroup.com" data-z="39" data-source-id="website" data-mask="none" data-laravel="true" data-laravel-value="{{$setting->site_url}}" data-case="original" data-font-family="Montserrat" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Montserrat.woff2')}}" style="left:76.77px;top:964.89px;width:277px;height:24px;transform:rotate(0deg);z-index:39;clip-path:inset(0px);font-family:Montserrat;font-size:19.6px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:23.52px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$setting->site_url}}</div>

  <div id="text-i9ywxr" class="item item--text item--text-i9ywxr" data-type="text" data-name="text-i9ywxr" data-merge="Loss or Theft of Card must be Immediately Reported to the Police" data-z="40" data-source-id="text-i9ywxr" data-mask="none" data-laravel="false" data-case="original" data-font-family="Montserrat" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Montserrat.woff2')}}" style="left:131.07px;top:860.31px;width:623px;height:20px;transform:rotate(0deg);z-index:40;clip-path:inset(0px);font-family:Montserrat;font-size:16.4px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:19.68px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">Loss or Theft of Card must be Immediately Reported to the Police </div>

  
  <!-- BEGIN: Layer 31: mobile (text) -->
  <div id="mobile" class="item item--text item--mobile" data-type="text" data-name="mobile" data-merge="+91-9000000000" data-z="43" data-source-id="mobile" data-mask="none" data-laravel="true" data-laravel-value="{{$setting->phone}}" data-case="original" data-font-family="Montserrat" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/Montserrat.woff2')}}" style="left:598.16px;top:964.89px;width:172px;height:24px;transform:rotate(0deg);z-index:43;clip-path:inset(0px);font-family:Montserrat;font-size:19.6px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:23.52px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$setting->phone}}</div>
  <!-- END: Layer 31: mobile (text) --></div></body></html>