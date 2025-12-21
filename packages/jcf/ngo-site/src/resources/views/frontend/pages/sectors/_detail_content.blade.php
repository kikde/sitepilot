<!-- Page Title -->
<section class="page-title style-two centred" style="background-image: url({{asset('/backend/uploads/'.$sectorpage->breadcrumb)}});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>{{$sectorpage->sector_name}}</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- service-details -->
<section class="service-details">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="service-sidebar">
                    <div class="sidebar-widget category-widget">
                        <ul class="category-list clearfix">
                            @foreach($sectors as $key=>$items)
                            <li><a href="{{url('/sector-details/'.$items->id.'/'.$items->slug)}}" class="{{$items->id == $sectorpage->id ? 'current' : ''}}">{{$items->sector_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="service-details-content">
                    <div class="content-one">
                        <div class="text mylist">
                            <p>{!!$sectorpage->description!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- service-details end -->

