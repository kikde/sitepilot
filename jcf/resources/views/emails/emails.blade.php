<!DOCTYPE html>
<html>
<head>
    <title>Travel Trade Cricket League</title>
</head>
<body>
    <div class="container">
        <div class="text-center"><img src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="" width="80" hight="80"></div>

         

    </div>
    
    <h1>Welcome, {{$guestplayer->firstname}}👋 TTCL Message  Here !!😃</h1>
    

   <img src="{{asset($guestplayer->screenshot)}}" alt=""  height="500">

</body>
</html>


   



