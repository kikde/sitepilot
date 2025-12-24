<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Official Letter2</title>
    <meta name="BPS" content="{{$setting->title}}">

    <link href="index.css" rel="stylesheet">

    <style>
        .textcolor{
            
        color:#00008B;
        font-family:Arial;
        font-size:37px;" 
        }
    </style>
</head>

<body>
    <div id="wb_Image1" style="position:absolute;left:3px;top:0px;width:2000px;height:2830px;z-index:0;">
        <img src="{{asset('frontend/custom/card/latter-1.png')}}" id="Image1" alt="" width="2000" height="2830"></div>
    <div id="wb_Text1" style="position:absolute;left:86px;top:449px;width:452px;height:42px;z-index:1;">
        <span style="color:#000000;font-family:Arial;font-size:37px;"><strong>Ref.- {{$jletter->regno}}</strong></span>
    </div>
    <div id="wb_Text2" style="position:absolute;left:1626px;top:449px;width:312px;height:42px;z-index:2;">
        <span style="color:#000000;font-family:Arial;font-size:37px;"><strong>Date:-{{$jletter->created_at->format('d-m-Y')}}</strong></span></div>
    <div id="wb_Text4"
        style="position:absolute;left:131px;top:739px;width:1802px;height:524px;text-align:justify;z-index:3;">
        <span style="color:#00008B;font-family:Arial;font-size:43px;"><strong>To,<br>The Superintendent Of Police <br>{{$jletter->city}}<br>{{$jletter->state}} -{{$jletter->pincode}}<br><br>Respected Sir,<br><br>We hereby inform you honor to Mrs/Mr.    {{$jletter->name}} appointed as a member of<br>{{$jletter->landmark}}, District-{{$jletter->city}}, {{$jletter->state}}, in our organization.<br></strong></span></div>
    <div id="wb_Text5" style="position:absolute;left:542px;top:1926px;width:922px;height:48px;z-index:4;">
        <span style="color:#000000;font-family:Arial;font-size:43px;"><strong>We wish all the success in their life
                regard.</strong></span></div>
    <div id="wb_Text6" style="position:absolute;left:131px;top:2090px;width:447px;height:42px;z-index:5;">
        <span style="color:#000000;font-family:Arial;font-size:37px;"><strong>Thank You with Regards</strong></span>
    </div>
    <div id="wb_Text7" style="position:absolute;left:131px;top:2337px;width:899px;height:161px;z-index:6;">
        <span style="color:#000000;font-family:Arial;font-size:35px;"><strong><em>Copy To<br>CC- The Public Relation
                Officer {{$jletter->city}}<br>CC- The Collector, District {{$jletter->city}}</em></strong></span></div>
    <div id="wb_Text8"
        style="position:absolute;left:1187px;top:2194px;width:590px;height:143px;text-align:center;z-index:7;">
        <span style="color:#000000;font-family:Arial;font-size:43px;"><strong>(President/MD)<br>{{$setting->title}}<br></strong></span></div>
    <div id="wb_Text3" style="position:absolute;left:170px;top:1320px;width:457px;height:48px;z-index:8;">
        <span style="color:#00008B;font-family:Arial;font-size:43px;"><strong>1- Mr. {{$jletter->name}} </strong></span></div>
    <div id="wb_Text9" style="position:absolute;left:814px;top:1303px;width:81px;height:83px;z-index:9;">
        <span style="color:#00008B;font-family:Arial;font-size:75px;">-</span></div>
    <div id="wb_Text10" style="position:absolute;left:1047px;top:1320px;width:790px;height:48px;z-index:10;">
        <span style="color:#00008B;font-family:Arial;font-size:43px;"><strong>{{$jletter->desg}}
            </strong></span></div>
    <div id="wb_Text11"
        style="position:absolute;left:131px;top:1496px;width:1807px;height:286px;text-align:justify;z-index:11;">
        <span style="color:#00008B;font-family:Arial;font-size:43px;"><strong>He/She authorized to collect news and
                advertisement for BPS ({{$setting->title}}) News Agency and will work for our trust Patrakar
                Sangthan. Kindly extend your all cooperation and assistance to above mention member to enable Him/Her
                to discharge his/her duties as authorized representatives of our association and online news channel
                Delhi91 BPS Live. We request to forward the necessary Press release &amp; Press Conferences details
                directly to his/her.</strong></span></div>
    <div id="wb_Text12" style="position:absolute;left:86px;top:556px;width:527px;height:42px;z-index:12;">
        {{-- <span class="textcolor"><strong>Reg. No.-{{$jletter->regno}}</strong></span> --}}
    </div>
    <div id="wb_Text13" style="position:absolute;left:1371px;top:556px;width:562px;height:42px;z-index:13;">
        {{-- <span class="textcolor"><strong>MSME Reg. No.-DL02D0007925</strong></span> --}}
    </div>
    <div id="wb_Image2" style="position:absolute;left:1382px;top:2054px;width:376px;height:382px;z-index:14;">
        <img src="{{asset('frontend/custom/stemp-signature.png')}}" id="Image2" alt="" width="376" height="411"></div>
</body>

</html>