@extends('frontend.layout.app')

@section('title') Home @endsection
@section('style') @endsection

@section('content')
  <!-- breadcrumb area start -->
  <div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Account</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- my account wrapper start -->
<div class="my-account-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row mb-20">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="{{ request()->tab == '' ? 'active' :'' }} {{ request()->tab == 'dashboad' ? 'active' : '' }}" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>
                                <a href="#orders" class="{{ request()->tab == 'orders' ? 'active' : '' }}" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                <a href="#shipping-address" class="{{ request()->tab == 'shipping-address' ? 'active' : '' }}" data-toggle="tab"><i class="fa fa-map-marker"></i>Shipping Address</a>
                                <a href="#account-info" class="{{ request()->tab == 'account-info' ? 'active' : '' }}" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                <a href="#change-password" class="{{ request()->tab == 'change-password' ? 'active' : '' }}" data-toggle="tab"><i class="fa fa-edit"></i>Change Password</a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                @include('frontend.user.dashboard.index')
                                @include('frontend.user.orders.index')
                                @include('frontend.user.shipping-address.index')
                                @include('frontend.user.account-details.index')
                                @include('frontend.user.change-password.index')
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->
@endsection


@section('script')
    <script>
        $(document).on('click','.myaccount-tab-menu a', function(){
            let tab = $(this).attr('href').replace('#', '').trim();
            window.history.pushState('tab', 'tab', '{{ url("home") }}'+'?tab='+tab);
        })
    </script>
@endsection

