<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- <link href="https://allfont.net/allfont.css?fonts=roboto-bold" rel="stylesheet" type="text/css" /> --}}
    <style>
        * {
            margin: 00px;
            padding: 00px;


        }

 .container {
  position: relative;
  text-align: center;
  font-family: 'Roboto Bold', arial;
}

.reg{
        position: absolute;
        font-size: 15px; 
        font-weight: 600;
        top:4%;
        left:35%;
        color:#ffff;
    }
    .date{
        position: absolute;
        font-size: 15px; 
        font-weight: 100;
        top:4%;
        left:65%;
        color:#ffff;
    }

    .logo img{
        position: absolute;
        border:2px solid;
        border-radius: 50%;
        height:150px;
        width:150px;
        top:5%;
        left:28%;
        background-color: #ffff;


    }
    .heading{
        position: absolute;
        color:#fff200;
        top:8.1%;
        left:44%;
        text-align: center;
        font-weight: 600px;
        font-size:20px;
        
    }

    .sitename{
        position: absolute;
        color:#ffff;
        top:12%;
        left:40%;
        text-align: center;
        font-weight:600px;
        font-size:40px;
        font: bold;
      
    }

   .address{
        position: absolute;
        color:#e6e7e8;
        top:20%;
        left:40%;
        text-align: center;
        font-weight:600px;
        font-size:20px;
        
   }

   .siteurl{
       position: absolute;
        font-size: 18px; 
        font-weight: 600;
        top:26%;
        left:58%;
        color:#fff200;

   }
   .phone{
       position: absolute;
        font-size: 18px; 
        font-weight: 600;
        top:26%;
        left:40%;
        color:#fff200;

   }

    .detail{
            text-align: justify;
            font-size: 20px;
            font-weight: 600;
          
        }
        .datax{
            text-align: justify;
          font-size: 20px;
          font-weight: 600;
      }
      table.frontcard{
        height:450px;
        width:750px;
        background-image: url('data:image/png;base64,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');
        background: no-repeat;

      }

      .profile{
        position: absolute;
        top:39%;
        left:28%;
      }

      .details{
        position: absolute;
        border: 1px solid;
        top:40%;
        left:45%;
        font-size:30px;
        font-weight: 600;
      }
      .details p{
        padding-right: 20px;
        text-align: justify;
      }
      .ps{
        padding-left:20px;
        text-align: justify;
      }
      .regn{
        position: absolute;
        top:80%;
        left:30%;

      }

      .rnum{
        position: absolute;
        top:87%;
        left:29%;
       

      }
    </style>

    <title>ID Card</title>

</head>

<body>

    <div class="container">
        <img class="image1"  src="{{asset('frontend/custom/membercard.png')}}" alt="Snow" style="width:50%;">

        <div class="logo">
           <img src="{{asset('backend/uploads/'.$setting->site_logo)}}" alt="">
        </div>
        <div class="reg">
            <p>Reg No.{{str_replace(' ', '', $data->created_at->format('d/m/Y') ?? '')}}</p>
          </div>
             
          <div class="date">
              <h3>Date-{{$data->created_at->format('d-m-Y') ?? ''}}</h3>
            </div>
           <div class="heading"><b>All India Working Organization</b></div>

           <div class="sitename"><b>{{$setting->title}}</b></div>

           <div class="address"><b>{{$setting->address}}</b></div>

           <div class="phone">
            <p>Call:-{{$setting->phone}}</p>
         </div>
          <div class="siteurl">
             <p>Web:-{{$setting->site_url}}</p>
           </div>

           <div class="profile"><img src="{{asset('backend/uploads/'.$data->images)}}" alt="" height="220" width="200"></div>
           <div class="details">
            <div class="row">
                <div class="col-5"  style="display:flex;">
                    <div class="col-2"><p>Name</p></div> 
                    <div class="col-1">:</div> 
                    <div class="col-2" >{{$data->name}}</div>
                </div>
                    
                <div class="col-5"  style="display:flex;"> 
                    <div class="col-2"><p>S/O,D/O,W/O</p></div>
                    <div class="col-1">:</div> 
                    <div class="col-2 ps" >{{$data->name}}</div>
                
                </div>
                <div class="col-5"  style="display:flex;"> 

                <div class="col-2"><p>Designation</p></div>
                <div class="col-1">:</div> 
                <div class="col-2 ps" >{{$data->profession}}</div>
                </div>

                <div class="col-5"  style="display:flex;"> 

                <div class="col-2"><p>Date Of Issue</p></div>
                <div class="col-1">:</div> 
                    <div class="col-2 ps" >{{$data->father_name}}</div>
                </div>
                <div class="col-5"  style="display:flex;"> 
                <div class="col-2"><p>Valid Date</p></div>
                <div class="col-1">:</div> 
                    <div class="col-2 ps" >{{$data->profession}}</div>
                </div>
                <div class="col-5"  style="display:flex;"> 
                <div class="col-2">Address</div>
                <div class="col-1">:</div> 
                <div class="col-2 ps" > {{$data->address}}</div>
                </div>
               </div>
           </div>
           <div class="regn"><h2>Reg. No.</h2></div>
           <div class="rnum"><h2>2023/455070</h2></div>


       

    </div>



</body>

</html>
