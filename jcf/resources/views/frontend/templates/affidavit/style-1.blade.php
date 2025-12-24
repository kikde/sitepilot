<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Affidavit Letter</title>

  <style>
@font-face{font-family:"ArchivoBlack";src:url("{{asset('frontend/custom/fonts/ArchivoBlack.woff2')}}") format("woff2");font-weight:900;font-style:normal;font-display:swap}
@font-face{font-family:"TelegrafUltraBold";src:url("{{asset('frontend/custom/fonts/TelegrafUltraBold.woff2')}}") format("woff2");font-weight:800;font-style:normal;font-display:swap}
@font-face{font-family:"Montserrat";src:url("{{asset('frontend/custom/fonts/Montserrat.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"horizen2";src:url("{{asset('frontend/custom/fonts/horizen2.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"Roboto";src:url("{{asset('frontend/custom/fonts/Roboto.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"MontserratExtraLight";src:url("{{asset('frontend/custom/fonts/MontserratExtraLight.woff2')}}") format("woff2");font-weight:200;font-style:normal;font-display:swap}
@font-face{font-family:"MontserratBlack";src:url("{{asset('frontend/custom/fonts/MontserratBlack.woff2')}}") format("woff2");font-weight:900;font-style:normal;font-display:swap}
@font-face{font-family:"gordita";src:url("{{asset('frontend/custom/fonts/gordita-light.woff2')}}") format("woff2");font-weight:300;font-style:normal;font-display:swap}
@font-face{font-family:"Gordita-RegularItalic";src:url("{{asset('frontend/custom/fonts/Gordita-RegularItalic.woff2')}}") format("woff2");font-weight:400;font-style:italic;font-display:swap}
@font-face{font-family:"Gordita";src:url("{{asset('frontend/custom/fonts/Gordita-Regular.woff2')}}") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"TT-Drugs-Bold";src:url("{{asset('frontend/custom/fonts/TT-Drugs-Bold-Italic.woff2')}}") format("woff2");font-weight:700;font-style:italic;font-display:swap}</style><style>
    @page { size: 209.98mm 297mm; margin: 0; }

    @page { size: 209.98mm 297mm; margin: 0; }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: #091225;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px;
      font-family: Roboto, system-ui, -apple-system, "Segoe UI", sans-serif;
    }
    #page {
      position: relative;
      width: 793.63px;
      height: 1122.52px;
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
      object-fit: cover;
    }
    .item { position: absolute; transform-origin: top left; }

    @media print {
      body { background: #fff; padding: 0; }
      #page { box-shadow: none; transform: none !important; }
    }

    /* Helper text styles */
    .t-center { text-align:center; }
    .t-justify { text-align:justify; }
  </style>
</head>

<body>
@php
  use Carbon\Carbon;

  $orgTitle   = $setting->title ?? 'YOUR NGO NAME';
  $ageText    = $aff->dob ? Carbon::parse($aff->dob)->age.' year' : '—';
  $placeCity  = $aff->city ?? '';
  $createdAt  = $aff->created_at ?? now();
  $weekday    = Carbon::parse($createdAt)->format('l');
  $dateMDY    = Carbon::parse($createdAt)->format('d-m-Y');
@endphp

<div id="page">
  <img id="bg" src="{{ asset('frontend/custom/card/letter-1.png') }}" alt="">

  {{-- ===== HEADER START ===== --}}

{{-- Logo (left) --}}
<div id="hdr-logo" class="item item--image" style="left:82px;top:58px;width:120px;height:120px;z-index:50;">
  <img src="{{ asset('backend/uploads/'.$setting->site_logo) }}"
       alt="logo"
       style="width:100%;height:100%;object-fit:contain;display:block;">
</div>

{{-- Big NGO Title (red) --}}
<div id="hdr-title" class="item item--text"
     style="left:245px;top:48px;width:560px;height:40px;z-index:51;
            font-family:ArchivoBlack;font-size:30px;font-weight:900;
            color:rgb(248,7,7);line-height:40px;letter-spacing:.5px;">
  {{ strtoupper($setting->title ?? 'YOUR NGO NAME') }}
</div>

{{-- CIN + REGD line --}}
<div id="hdr-cin-regd" class="item item--text"
     style="left:265px;top:90px;width:560px;height:20px;z-index:52;
            font-family:Roboto;font-size:14px;font-weight:700;
            color:rgb(34,34,34);line-height:18px;">
  <span style="margin-right:26px;">
    CIN No. {{ $setting->cin_no ?? $setting->company_no ?? '—' }}
  </span>
  <span>
    REGD. No. {{ $setting->reg_no ?? $setting->registration_no ?? '—' }}
  </span>
</div>

{{-- Blue divider line (optional, matches your image style) --}}
<!-- <div id="hdr-divider" class="item item--text"
     style="left:185px;top:112px;width:560px;height:2px;z-index:53;background:rgb(34,52,171);">
</div> -->

{{-- Unit line (blue) --}}
<div id="hdr-unit" class="item item--text"
     style="left:265px;top:120px;width:560px;height:18px;z-index:54;
            font-family:ArchivoBlack;font-size:14px;font-weight:700;
            color:rgb(34,52,171);line-height:18px;">
  A Unit Of {{ $setting->title ?? 'Your NGO NAME' }} Regd. By Govt. Of India
</div>

{{-- Address line (small) --}}
<div id="hdr-address" class="item item--text"
     style="left:270px;top:140px;width:560px;height:18px;z-index:55;
            font-family:Montserrat;font-size:13px;font-weight:400;
            color:rgb(34,34,34);line-height:16px;">
  {{ $setting->address ?? '' }}
</div>

{{-- ===== HEADER END ===== --}}


  {{-- Title --}}
  <div class="item" style="left:40px; top:197px; width:710px; font-family:ArchivoBlack; font-size:28px; font-weight:700; color:#1f2ea8;" >
    <div class="t-center" style="text-transform:uppercase; text-decoration:underline;">
      AFFIDAVIT TO {{ $orgTitle }}
    </div>
  </div>

  {{-- Intro paragraph --}}
  <div class="item" style="left:80px; top:270px; width:640px; font-family:gordita; font-size:18px; line-height:1.35; color:#0033ff; font-weight:700;">
    <div class="t-justify">
      I {{ $aff->name }} s/o/d/o {{ $aff->fname }} R/O {{ $aff->address }},
      {{ $aff->city }}, {{ $aff->state }} aged about {{ $ageText }}
      do hereby solemnly affirm and declare as under:-
    </div>
  </div>

  {{-- List points --}}
  <div class="item" style="left:95px; top:380px; width:625px; font-family:Montserrat; font-size:18px; line-height:1.35; color:#0033ff;">
    <ol style="margin:0; padding-left:22px;">
      <li style="margin-bottom:18px;">
        That I have read and understood object of {{ $orgTitle }}
        (A unit of MCA registered under the Trust Act 1882 registration no. {{$setting->reg_no}}.)
      </li>
      <li style="margin-bottom:18px;">
        That it is clarified at the outset that I am not an agent of the above stated trust
        but have undertaken to work with sole object of achieving the objects of the trust
        in the interest of society and the nation at large and without any payment.
      </li>
      <li style="margin-bottom:18px;">
        That I undertake not to indulge in any illegal/unlawful activities and if I do so,
        I would be solely responsible and liable for the acts and deeds of mine and the trust
        or any of its office bearers would have nothing to do with it.
      </li>
      <li style="margin-bottom:18px;">
        That I have read and understood the contents of the above affidavit which is true
        and correct to the best of my knowledge and nothing has been concealed.
      </li>
      <li style="margin-bottom:0;">
        Solemnly affirmed and signed in my presence on this the {{ $weekday }}
        of {{ $dateMDY }} after reading the contents of this affidavit.
      </li>
    </ol>
  </div>

  {{-- Deponent --}}
  <div class="item" style="left:540px; top:900px; width:210px; font-family:gordita; font-size:18px; color:#0033ff; font-weight:700; text-align:right;">
    (DEPONENT)
  </div>

  {{-- Verification line --}}
  <div class="item" style="left:95px; top:965px; width:625px; font-family:gordita; font-size:18px; line-height:1.35; color:#0033ff; font-weight:700;">
    Verified at {{ $placeCity }} on this the {{ $weekday }} of {{ $dateMDY }}.
  </div>
  <div id="text-ozel4q" class="item item--text item--text-ozel4q" data-type="text" data-name="text-ozel4q" data-merge="Regd. Office: Meera Institue of Sahab ki Merta City Dist. Nagpur (Raj.) 341510" data-z="28" data-source-id="text-ozel4q" data-mask="none" data-case="original" data-font-family="TT-Drugs-Bold" data-font-weight="400" data-font-style="normal" data-font-path="{{asset('frontend/custom/fonts/TT-Drugs-Bold.woff2')}}" style="left:40.05px;top:1052.28px;width:700px;height:19px;transform:rotate(0deg);z-index:28;clip-path:inset(0px);font-family:TT-Drugs-Bold;font-size:16px;font-weight:400;font-style:normal;color:rgb(248, 7, 7);text-align:center;line-height:19.2px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">{{$setting->address}}</div>
 

  <div id="web:_www.meeraedu.org" class="item item--text item--web-www-meeraedu-org" data-type="text" data-name="web:{{$setting->title}}" data-merge="web: www.meeraedu.org" data-z="30" data-source-id="text-0d4cx3" data-mask="none" style="left:77.85px;top:1078.96px;width:206px;height:17px;transform:rotate(0deg);z-index:30;clip-path:inset(0px);font-family:TT-Drugs-Bold;font-size:14px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:16.8px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">web: {{$setting->site_url}}</div>

  <div id="Help_Line" class="item item--text item--help-line" data-type="text" data-name="Help Line No: {{ $setting->phone }}" data-merge="Help Line No: 9865442585" data-z="31" data-source-id="text-0kygn1" data-mask="none" style="left:306.75px;top:1081.19px;width:198px;height:16px;transform:rotate(0deg);z-index:31;clip-path:inset(0px);font-family:TT-Drugs-Bold;font-size:13px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:left;line-height:15.6px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">Help Line No:{{$setting->phone}}</div>
 
  <div id="Email:_help_dmeerali.org" class="item item--text item--email-help-dmeerali-org" data-type="text" data-name="Email: help@dmeerali.org" data-merge="Email: help@dmeerali.org" data-z="32" data-source-id="text-lo8feu" data-mask="none" style="left:500.09px;top:1078.53px;width:206px;height:17px;transform:rotate(0deg);z-index:32;clip-path:inset(0px);font-family:TT-Drugs-Bold;font-size:14px;font-weight:400;font-style:normal;color:rgb(34, 34, 34);text-align:right;line-height:16.8px;letter-spacing:0px;background:transparent;padding:0px 0px 0px 0px;white-space:pre-wrap;word-break:break-word;overflow-wrap:normal;overflow:visible;">Email: {{ $setting->site_email }}</div>
 
</div>
</body>
</html>
