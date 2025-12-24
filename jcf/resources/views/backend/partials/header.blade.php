<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('/')}}" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
          
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name}}</span><span class="user-status"> @if(Auth::user()->role == 1)Admin @else Member @endif</span></div><span class="avatar">
                        
                        @if(Auth::user()->role == 1)
                         @if(Auth::user()->profile_image)
                        <img class="round" src="{{asset('/backend/uploads/admin/'.Auth::user()->profile_image)}}" alt="avatar" height="40" width="40">
                        @else
                        <img class="round" src="{{asset('/backend/uploads/user.jpg')}}" alt="avatar" height="40" width="40">
                        @endif
                        @else
                         <img class="round"
                         src="{{ Auth::user()->profile_image
                                ? asset('backend/uploads/members/'.Auth::user()->profile_image)
                                : asset('backend/uploads/user.jpg') }}"
                         alt="avatar" height="40" width="40">
                        @endif 
                        
                        <span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                     @if(Auth::user()->role == '1')
                    <a class="dropdown-item" href="{{url('/profile/'.Auth::user()->id)}}"><i class="mr-50" data-feather="user"></i> Profile</a>
                     @elseif(Auth::user()->role == '2')
                     <a class="dropdown-item" href="{{url('/user-edit/'.Auth::user()->id)}}"><i class="mr-50" data-feather="user"></i> Profile</a>
                     @endif
                    <!-- <a class="dropdown-item" href="{{url('/setting')}}"><i class="mr-50" data-feather="settings"></i> Settings</a> -->

                        <a class="dropdown-item" href="{{route('logout')}}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="mr-50" data-feather="power"></i> 
                           
                            Logout
                        </a>
                
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    
                </div>
            </li>
        </ul>
    </div>
</nav>


<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>
<!-- END: Header-->