<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Personal Website</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/assets/css/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/assets/css/bootstrap4-toggle.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/assets/css/select2.min.css')}}">
    @yield('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/assets/css/style.css') }}">
</head>

<body>
    <div class="main-wrapper">
       @include('admin.layout.header')
       @include('admin.layout.sidebar')
        <div class="page-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('admin_assets/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<script src="{{ asset('admin_assets/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/select2.min.js')}}"></script>
    <script src="{{ asset('admin_assets/assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/bootstrap4-toggle.min.js') }}"></script>

    @yield('script')
    <script src="{{ asset('admin_assets/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/common.js') }}"></script>

    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    </script>
    @if(Session::has('success'))
        <script>
            toastr.success('{{ Session::get('success') }}', 'Success!')
        </script>
    @endif

    <script>
        function setLoader(){
            let button = $(".submit-button");
            let loaderSpiner = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
            `;
            button.attr('disabled', 'disabled');
            button.html(loaderSpiner)
            // setTimeout(() => {
            //     button.removeAttr('disabled');
            // }, 4000);
        };
    </script>

</body>

</html>
