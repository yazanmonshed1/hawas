
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title','NadSoft Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="NadSoft" name="author"/>


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/nadsoft-logo.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app-' . config('admin.lang_direction', 'ltr') . '.min.css') }}"
        id="app-style" rel="stylesheet" type="text/css" />

    <!-- Customize Css  -->
    @yield('style')
</head>

<body data-sidebar="dark">

    @yield('body')

<!-- JAVASCRIPT -->

<script src="{{asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>


    @yield('script')
</body>

</html>
