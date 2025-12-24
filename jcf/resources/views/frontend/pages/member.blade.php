@extends('layouts.master')

@section('content')
<!-- Page Title -->
<!-- <section class="page-title style-two centred"
         style="background-image:url({{ asset('frontend/assets/images/background/members.png') }});">
  <div class="auto-container">
    <div class="content-box">
      <div class="title">
        <h1>Members of Our Foundation</h1>
      </div>
    </div>
  </div>
</section> -->
<!-- End Page Title -->
<!-- Members page -->
<section class="shop-page-section">
  <div class="auto-container">
    <div class="row clearfix">
      <!-- Sidebar -->
      <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
        <div class="shop-sidebar">
          <!-- Search -->
          <div class="sidebar-search">
            <form action="{{ url('/searchby') }}" method="POST" class="search-form">
              @csrf
              <div class="form-group">
                <input type="search" name="searchinput" placeholder="Search..." required>
                <button type="submit"><i class="flaticon-loupe"></i></button>
              </div>
            </form>
          </div>

          <!-- About / Quick links -->
          <div class="sidebar-widget category-widget">
            <div class="widget-title">
              <h5>About Us</h5>
            </div>
            <div class="widget-content">
              <ul class="category-list clearfix">
                <li><a href="{{ url('/success-story') }}">Success Stories</a></li>
                <li><a href="{{ url('/complain-form') }}">Support Ticket</a></li>
                <li><a href="{{ url('/user-donate') }}">Donate Now</a></li>
              </ul>
            </div>
          </div>

          <!-- Latest Members -->
          <div class="sidebar-widget post-widget">
            <div class="widget-title">
              <h5>New Members</h5>
            </div>
            <div class="post-inner">
                           @if(count($latestMembers)> 0)
              @foreach($latestMembers as $member)
                <div class="post">
                  <figure class="post-thumb">
                        @if($member->profile_image)
                         <img src="{{asset('backend/uploads/members/'.$member->profile_image)}}" alt="" style="height:68px">
                         @else
                         <img src="{{asset('frontend/custom/user.png')}}" alt="">
                        @endif
                  </figure>
                  <a href="#">{{ $member->name }}</a>
                </div>
               @endforeach
               @else
              <p class="text-muted">No new members yet.</p>
               @endif
            </div>
          </div>
        </div>
      </div>
      <!-- /Sidebar -->

      <!-- Main content -->
      <div class="col-lg-9 col-md-12 col-sm-12 content-side">
        <div class="our-shop">

          <!-- Top bar -->
          <div class="item-shorting clearfix">
            <div class="text pull-left">
              @php
                $from = ($members->currentPage() - 1) * $members->perPage() + 1;
                $to   = min($members->currentPage() * $members->perPage(), $memberCount);
              @endphp
              <p>Showing {{ $memberCount ? $from : 0 }}–{{ $memberCount ? $to : 0 }} of {{ $memberCount }} results</p>
            </div>

            <div class="short-box pull-right clearfix">
              <p>Sort by:</p>
              <div class="select-box">
                {{-- Replace the values with your actual listing routes/URLs --}}
                <select class="wide" onchange="if(this.value){ window.location.href=this.value; }">
                  <option value="" selected>New Members</option>
                  <option value="{{ url('/members?sort=new') }}">New Members</option>
                  <option value="{{ url('/members?sort=name_asc') }}">Name (A–Z)</option>
                  <option value="{{ url('/members?sort=name_desc') }}">Name (Z–A)</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /Top bar -->

          @if($members->count() > 0)
            <div class="row clearfix">
              @foreach($members as $member)
                <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                  <div class="shop-block-one">
                    <div class="inner-box">
                      <figure class="image-box">
                        @php
                          $img = $member->profile_image
                            ? asset('backend/uploads/members/'.$member->profile_image)
                            : asset('backend/uploads/user.jpg');
                        @endphp
                        <img src="{{ $img }}" alt="member {{ $member->name }}" style="height:250px; width:100%; object-fit:cover;">
                      </figure>

                      <div class="lower-content">
                        {{-- Rating (optional) --}}
                        @php
                          $stars = (int)($member->rating ?? 0);
                          $stars = max(0, min(5, $stars));
                        @endphp
                        @if($stars > 0)
                          <ul class="rating-box clearfix">
                            @for ($i = 0; $i < $stars; $i++)
                              <li><i class="flaticon-star"></i></li>
                            @endfor
                          </ul>
                        @endif

                        <div class="mt-2">{{ $member->name }}</div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- Pagination -->
            {{ $members->links('vendor.pagination.default') }}
          @else
            <h5 class="text-center">No members found.</h5>
          @endif
        </div>
      </div>
      <!-- /Main content -->
    </div>
  </div>
</section>
<!-- /Members page -->
   @include('frontend.partials.donate.style-6')
@endsection
