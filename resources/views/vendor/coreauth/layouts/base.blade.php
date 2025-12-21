<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    @php
        $setting = $setting ?? null;
        if (!$setting) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                    $q = \Illuminate\Support\Facades\DB::table('settings');
                    if (function_exists('tenant_id') && \Illuminate\Support\Facades\Schema::hasColumn('settings', 'tenant_id')) {
                        $q->where('tenant_id', tenant_id());
                    }
                    $setting = $q->first();
                }
            } catch (\Throwable $e) {
                $setting = null;
            }
        }
        if (!$setting) {
            $setting = (object) [
                'title' => config('app.name', 'BaseProject'),
                'meta_description' => '',
                'meta_keywords' => '',
                'meta_author' => '',
                'favicon_icon' => null,
            ];
        }
    @endphp
    <meta name="description" content="{{ $setting->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $setting->meta_keywords ?? '' }}">
    <meta name="author" content="{{ $setting->meta_author ?? '' }}">
    <title>{{ $setting->title ?? config('app.name', 'BaseProject') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('backend/app-assets/images/ico/apple-icon-120.png') }}">
    @if(!empty($setting->favicon_icon))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/icons/'.$setting->favicon_icon) }}">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">

    <style>
        .brand-wrap{display:flex; align-items:center; gap:10px}
        .brand-badge{width:34px;height:34px;border-radius:10px;background:#111827;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:900}
        .brand-title{font-weight:900; margin:0; line-height:1.1}
        .brand-sub{font-size:12px; color:#6b7280; font-weight:700}
        .menu-section{margin:14px 0 6px; padding:0 18px; font-size:12px; letter-spacing:.14em; text-transform:uppercase; color:#6b7280; font-weight:900}
        .menu-item-pill{display:inline-flex; align-items:center; gap:8px; padding:2px 10px; border-radius:999px; background:rgba(37,99,235,.10); color:#1d4ed8; font-weight:800; font-size:12px}
    </style>

    @stack('head')
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    @include('coreauth::partials.header')
    @include('coreauth::partials.sidebar')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mx-2" role="alert">
                        <ul style="margin:0; padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <script src="{{ asset('backend/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/core/app.js') }}"></script>
    <script>
        $(window).on('load', function() {
            if (window.feather) {
                window.feather.replace({ width: 14, height: 14 });
            }
        })
    </script>
    @stack('scripts')
</body>
</html>

