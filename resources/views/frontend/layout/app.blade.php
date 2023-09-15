<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <!-- Site title -->
    <title>Galio - @yield('title')</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend_assets/assets/img/favicon.ico')}}" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend_assets/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="{{ asset('frontend_assets/assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- helper class css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/assets/css/toastr.css')}}">

    <link href="{{ asset('frontend_assets/assets/css/helper.min.css')}}" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="{{ asset('frontend_assets/assets/css/plugins.css')}}" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="{{ asset('frontend_assets/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/assets/css/skin-default.css')}}" rel="stylesheet" id="galio-skin">
    <style>
        .header-top-area .header-call-action a:hover {
            color: #fff !important;
        }
        .header-top-area .header-top-right ul li a:hover {
            color: #fff !important;
        }
        .footer-bottom-wrap .copyright-text p a {
            color: #fff !important;
        }
    </style>
    @yield('style')
</head>

<body>
    <div class="wrapper">
        <!-- header area start -->
        @include('frontend.layout.header')
        <!-- header area end -->

        @yield('content')

        <!-- footer area start -->
        @include('frontend.layout.footer')
        <!-- footer area end -->
    </div>
    <!-- Quick view modal start -->
    @include('frontend.__pertials.quick-view')
    <!-- Quick view modal end -->

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->

    <div style="display: none">
        <input type="hidden" id="wishlist_add_url" value="{{ route('wishlist') }}"/>
        <input type="hidden" id="wishlist_remove_url" value="{{ route('wishlist.remove') }}"/>
        <input type="hidden" id="subscribe_url" value="{{ route('frontend.subscribe') }}"/>
    </div>
    <!--All jQuery, Third Party Plugins & Activation (main.js) Files-->
    <script src="{{ asset('frontend_assets/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <!-- Jquery Min Js -->
    <script src="{{ asset('frontend_assets/assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <!-- Popper Min Js -->
    <script src="{{ asset('frontend_assets/assets/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap Min Js -->
    <script src="{{ asset('frontend_assets/assets/js/vendor/bootstrap.min.js')}}"></script>
    <!-- Plugins Js-->
    <script src="{{ asset('frontend_assets/assets/js/plugins.js')}}"></script>
    <!-- Ajax Mail Js -->
    <script src="{{ asset('frontend_assets/assets/js/ajax-mail.js')}}"></script>
    <!-- Active Js -->
    <script src="{{ asset('admin_assets/assets/js/toastr.min.js') }}"></script>

    <script src="{{ asset('frontend_assets/assets/js/main.js')}}"></script>

    <script src="{{ asset('frontend_assets/assets/js/rasel.js')}}"></script>

    <!-- Switcher JS [Please Remove this when Choose your Final Projct] -->
    <script src="{{ asset('frontend_assets/assets/js/switcher.js')}}"></script>

    @yield('script')
    @if(Session::has('success'))
        <script>
            toastr.success('{{ Session::get("success") }}', 'Success!')
        </script>
    @endif
    @if(Session::has('error'))
    <script>
        toastr.error('{{ Session::get("error") }}', 'Error!')
    </script>
@endif
</body>



</html>
