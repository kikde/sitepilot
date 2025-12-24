<!-- Volunteers/Members-page-section -->

<section class="shop-page-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h6>Team of NGO</h6>
            <h2>Our Members  </h2>
        </div>
        <div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12 content-side">
        <div class="our-shop">

    @if(count($members)> 0)

    <div class="row clearfix">
        @foreach($members as $list)
        <div class="col-lg-3 col-md-6 col-sm-12 shop-block">
            <div class="shop-block-one">
                <div class="inner-box">
                    <figure class="image-box">
                       
                        @if($list->profile_image)
                        <img src="{{asset('backend/uploads/'.$list->profile_image)}}" alt="member" style="height:250px">
                        @else
                        <img src="{{asset('backend/uploads/user.jpg')}}" alt="member">
                        @endif

                    </figure>
                    <div class="lower-content">
                        
                       
                            <h4>{{$list->name}}</h4>
                            <!--<span class="designation">{{$list->city}} </span>-->
                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <h5 class="justify-content-center"> No Data found</h5>
    @endif
    </div>

    </div>
    </div>

    <div class="btn-box text-center">
        <a href="{{url('/our-members')}}" class="theme-btn-four thm-btn">View All Members</a>
    </div>


    </div>

    
</section>


<!-- Volunteers/Member-page-section end -->
