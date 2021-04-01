<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!--  Meta Tag -->
    @include('layouts.meta_tag')

    <!-- Styles -->

    <!-- Jquery & Bootstrap-->
    <link rel="stylesheet" href="{{ asset('assets/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('admin/assets/libs/toastr/build/toastr.min.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if (config('app.Accessible_Tools') == true)
        <link rel="stylesheet" href="{{ asset('assets/plugins/accessible/open-accessibility.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/accessible/open-accessibility-responsive.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/components/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/footer.css') }}">

    @yield('style')

    <!-- End Style -->


    <!-- Fonts -->

    <!--  Please Add Fonts link here  -->
    @yield('fonts')


    <!-- End Fonts -->


    @if (config('app.Google_Analytics_ID') != null)
        <!-- Google Analytics -->
        @include('layouts.google_analytics')
        <!--  End Google Analytics -->
    @endif

</head>

<body>
    {{-- @include('layouts.navbar') --}}
    @widget('Navbar')

    @yield('body')



    @include('layouts.footer')

    @include('layouts.modals.login')

    <!-- Jquery & Bootstrap JS-->
    <script src="{{ asset('assets/lib/jquery/jquery-1.11.1.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/@popperjs/core@2"> </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/lib/bootstrap/bootstrap.min.js') }}"></script>
    <!--  End Jquery & Bootstrap JS -->

    <script src="{{ asset('assets/js/components/main.js') }}"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @if (config('app.Accessible_Tools') == true)
        <!-- Accessible JS -->
        <script src="{{ asset('assets/plugins/accessible/open-accessibility.min.js') }}"></script>
        <script>
            $('html').openAccessibility({
                localization: ['{{ app()->getLocale() }}'],
                isMobileEnabled: true,


            });

        </script>
        <!-- End Accessible JS -->
    @endif

    @if (config('app.Google_Map_Key') != null)
        <!-- Google Map -->
        @include('layouts.google_map')
        <!--  End Google Map -->
    @endif


    <script src="{{ asset('assets/plugins/lightbox/lightbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/libs/toastr/build/toastr.min.js') }}"></script>
    @yield('script')

    @if (Session::has('success_message'))
        <script>
            toastr.success("{{ Session::get('success_message') }}")

        </script>
    @endif
    @if (Session::has('error_message'))
        <script>
            toastr.error("{{ Session::get('error_message') }}")

        </script>
    @endif

</body>

</html>
