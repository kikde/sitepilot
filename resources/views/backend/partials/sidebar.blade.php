@php
  $user = \Illuminate\Support\Facades\Auth::user();
  $role = $user?->role;
  $showAdminMenu = in_array((int)($role ?? -1), [0,1,3], true);
  $showMemberMenu = ((int)($role ?? -1) === 2) || ((int)($role ?? -1) === 0);

  // In the new CoreAuth multi-tenant system, users may not have the legacy `users.role` column.
  // Map CoreAuth tenant permissions to legacy role checks so the full sidebar still appears.
  try {
    if ($user && $role === null && class_exists(\Dapunjabi\CoreAuth\Support\TenantManager::class)) {
      $tm = app(\Dapunjabi\CoreAuth\Support\TenantManager::class);
      $tenantId = $tm->current()?->id ?? (function_exists('tenant_id') ? tenant_id() : null);
      $uid = (int) $user->id;
      $canManageContent = $tenantId ? $tm->userHasPermission($uid, 'content.manage', (int) $tenantId) : false;
      $canManageRoles = $tenantId ? $tm->userHasPermission($uid, 'manage-roles', (int) $tenantId) : false;
      $canManagePermissions = $tenantId ? $tm->userHasPermission($uid, 'manage-permissions', (int) $tenantId) : false;
      $showAdminMenu = $canManageContent || $canManageRoles || $canManagePermissions || $showAdminMenu;
      $showMemberMenu = !$showAdminMenu;

      // Show full legacy admin sidebar for tenant admins/editors.
      $role = ($canManageContent || $canManageRoles || $canManagePermissions) ? 0 : 2;
    }
  } catch (\Throwable $e) {}
@endphp

  <!-- BEGIN: Main Menu-->
  <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href=""><span class="brand-logo">
                <img src="{{ asset('backend/icons/'.$setting->favicon_icon) }}"></span>
                   @php
    $raw         = (string)($setting->title ?? '');
    $noSpaces    = str_replace(' ', '', $raw);          // remove spaces
    $brandShort  = mb_strtoupper(mb_substr($noSpaces, 0, 8)); // first 8 chars, upper
@endphp

<h2 class="brand-text text-danger mb-0 brand-wrap">{{ $brandShort }}</h2>

                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
             
            @if ($showMemberMenu) 
            <li class=" nav-item {{Request::is('home') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/home')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>           
            </li>
            
            @if (Module::has('User'))
            

            <li class="nav-item {{Request::is('edit-profile') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{('/user-edit/'.Auth::user()->id)}}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Users">Edit Profile</span></a>
               
            </li>
            <li class="{{Request::is('/users-add') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/users-add')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add Member</span></a>
                    </li>
                <li class="nav-item {{Request::is('userslist') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/userslist')}}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Users">My Refferel</span></a>
                         </li> 

            
             @endif

             @endif

            <!-- MANAGER Permission-->

              @if ($showAdminMenu) 
               <li class="nav-item {{Request::is('edit-profile') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{('/user-edit/'.Auth::user()->id)}}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Users">Edit Profile</span></a>
               
               </li>
                <li class="nav-item {{Request::is('home') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/home')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>           
                </li>
                <li class="nav-item {{Request::is('userslist') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/userslist')}}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Users">Users</span></a>
                </li>
                    @if (Module::has('User'))
                    <li class="nav-item {{Request::is('users') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{route('users.index')}}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Users">Admin</span></a> </li>      
                    <li class="{{Request::is('home/banner-list') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/home/banner-list')}}"><i data-feather="monitor"></i><span class="menu-item text-truncate" data-i18n="List">Banners</span></a>
                    </li>
                    <li class="{{Request::is('home/what-to-do-list') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/home/what-to-do-list')}}"><i data-feather="check-square"></i><span class="menu-item text-truncate" data-i18n="List">What to do</span></a>
                    </li>
                    <li class="{{Request::is('home/static-section') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/home/static-section')}}"><i data-feather="box"></i><span class="menu-item text-truncate" data-i18n="List">Award Static</span></a>
                    </li>
                    <li class="{{Request::is('/home/award-section') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/home/award-section')}}"><i data-feather="award"></i><span class="menu-item text-truncate" data-i18n="List">Award Section</span></a>
                    </li>
                    <li class="{{Request::is('management-team') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{route('management-team.index')}}"><i data-feather="layers"></i><span class="menu-item text-truncate" data-i18n="List">Management Team</span></a>
                    </li>
                    <li class="{{Request::is('testimonials') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{route('testimonials.index')}}"><i data-feather="message-circle"></i><span class="menu-item text-truncate" data-i18n="List">Testimonials</span></a>
                    </li>
                    <li class="{{Request::is('faqs') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{route('faqs.index')}}"><i data-feather="twitch"></i><span class="menu-item text-truncate" data-i18n="List">Faq</span></a>
                    </li>

                    <li><a class="d-flex align-items-center" href="{{url('/pageList')}}"><i data-feather="columns"></i><span class="menu-item text-truncate" data-i18n="List">Create Page</span></a>
                    </li>
            @endif
                @if (Module::has('Gallery'))
                    <li class="{{ Request::is('photogallery') && request('share_site') == 'gallery' ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/photogallery?share_site=gallery') }}">
                                <i data-feather="image"></i>
                                <span class="menu-item text-truncate" data-i18n="User">Photo Gallery</span>
                            </a>
                        </li>
                        <li class="{{Request::is('videogallery') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/videogallery')}}"><i data-feather="video"></i><span class="menu-item text-truncate" data-i18n="List">Video Gallery</span></a>
                        </li>
                         <li class="{{ (Request::is('photogallery') && request('share_site')=='certificate') ? 'active': '' }}">
                            <a class="d-flex align-items-center" href="{{ url('/photogallery?share_site=certificate') }}">
                                <i data-feather="file"></i>
                                <span class="menu-item text-truncate" data-i18n="List">Certificates</span>
                            </a>
                          </li>
            @endif
            
            <li class="nav-item {{Request::is('donors') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{ route('donors.index')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Our Donors</span></a>                
            </li> 
            <li class="nav-item {{Request::is('donations') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{ route('donations.index')}}"><i data-feather="gift"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Donations</span></a>                
            </li> 
            <li class="{{Request::is('bank-details') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{route('donations.bank-details')}}"><i data-feather="lock"></i><span class="menu-item text-truncate" data-i18n="List">Bank Details</span></a>
                    </li>

           
            <li class="nav-item {{Request::is('support-tickets') ? 'active': ''}}"><a class="d-flex align-items-center" href="#"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Users">Support Tickets</span></a>
                <ul class="menu-content"> 
                    <li class="{{Request::is('support-tickets') ? 'active': ''}}" ><a class="d-flex align-items-center" href="{{url('/support-tickets')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">All Tickets</span></a>
                    </li>
                    <li class="{{Request::is('support-tickets/new') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/support-tickets/new')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add New Ticket</span></a>
                    </li>
                    <li class="{{Request::is('department') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{url('/department')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Departments</span></a>
                    </li>

                    
                </ul>
            </li>

            @if (Module::has('Setting'))
            <li class=" nav-item {{Request::is('setting') ? 'active': ''}}"><a class="d-flex align-items-center" href="{{route('settings.index')}}"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Settings">Settings</span></a>
            </li>
            @endif

            @endif

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
