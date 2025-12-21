<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                'favicon_icon' => null,
            ];
        }
    @endphp

    <title>{{ $setting->title ?? config('app.name', 'BaseProject') }}</title>
    @if(!empty($setting->favicon_icon))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/icons/'.$setting->favicon_icon) }}">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/page-auth.css') }}">

    @stack('head')
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
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

    <script src="{{ asset('backend/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/core/app.js') }}"></script>
    <script>
        $(window).on('load', function () {
            if (window.feather) {
                window.feather.replace({width: 14, height: 14});
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

