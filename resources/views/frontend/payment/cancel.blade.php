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
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Success</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
 <!-- login register wrapper start -->
 <div class="login-register-wrapper mb-5">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <div class="col-lg-2"></div>
                <!-- Login Content Start -->
                <div class="col-lg-8 payment-card-common">
                    <div class="vh-100 d-flex justify-content-center align-items-center">
                        <div>
                            <div class="mb-4 text-center">
                                <img src="{{ asset('frontend_assets/assets/img/payment-cancel.png') }}" class="img-fluid" style="max-width: 80px">
                            </div>
                            <div class="text-center">
                                <h1>Opps!</h1>
                                <p>Your payment has ben canceled. You can go back to Home page or go for buy somethig in Shop Page.
                                </p>
                                <br/>
                                <a href="{{ route('frontend.home') }}" class="btn btn-danger">Back to Home</a>
                                <a href="{{ url('/shop') }}" class="btn btn-warning">Back to Shop</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Login Content End -->

                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
<!-- login register wrapper end -->
@endsection


@section('script') @endsection

