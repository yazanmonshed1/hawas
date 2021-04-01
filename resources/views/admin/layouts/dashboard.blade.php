<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','NadSoft Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="NadSoft" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/nadsoft-logo.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app-' . config('admin.lang_direction', 'ltr') . '.min.css') }}"
        rel="stylesheet" type="text/css" />

    {{-- Temproary - this will be deleted --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet"
        type="text/css" />

    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/toastr/build/toastr.min.css') }}">

    {{-- Jquery File uploader --}}
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/libs/uploader/dist/css/jquery.dm-uploader.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/dropzone/min/dropzone.min.css') }}">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }}">

    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Customize Css  -->
    @yield('style')

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">

        @include('admin.layouts.components.top-header')
        @include('admin.layouts.components.vertical-menu')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('body')
                </div>
            </div>
            @include('admin.layouts.components.footer')
        </div>
        @include('admin.layouts.components.right-sidebar')

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

    </div>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/jquery-ajax-submit.js') }}"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    {{-- <script src="{{ asset('admin/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script> --}}

    <script type="text/javascript"
        src="{{ asset('admin/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/libs/jszip/jszip.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('admin/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>

    {{-- select2 --}}
    <script type="text/javascript" src="{{ asset('admin/assets/libs/select2/js/select2.full.min.js') }}"></script>

    {{-- Toastr --}}
    <script type="text/javascript" src="{{ asset('admin/assets/libs/toastr/build/toastr.min.js') }}"></script>

    {{-- File uploader --}}
    <script type="text/javascript" src="{{ asset('admin/assets/libs/uploader/dist/js/jquery.dm-uploader.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('admin/assets/libs/dropzone/min/dropzone.min.js') }}"></script>

     <script type="text/javascript" src="{{asset('admin/assets/libs/ckeditor/ckeditor.js')}}"></script>
     <script type="text/javascript" src="{{ asset('assets/plugins/ck-editor/ar.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('admin/assets/libs/ckeditor-plugins/plugin.js') }}"></script>

    <script type="text/javascript" src="{{ asset('admin/assets/js/app.js') }}"></script>

    @if (Session::has('success_message')) {
        <script>
            toastr.success("{{ Session::get('success_message') }}")

        </script>
        }
    @endif
    @if (Session::has('error_message')) {
        <script>
            toastr.error("{{ Session::get('error_message') }}")

        </script>
        }
    @endif



    @yield('script')
</body>

</html>
