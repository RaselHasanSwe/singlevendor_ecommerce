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
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="75" height="75"
                                    fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <h1>Thank You !</h1>
                                <p>We received your purchase request. We'll be in touch shortly.
                                    We had sent invoice details to you email account.
                                    If you want to see order update plase login
                                </p>
                                <br/>
                                <a href="{{ route('frontend.home') }}" class="btn btn-danger">Back to Home</a>
                                <a href="{{ route('login') }}" class="btn btn-warning">Login for order update</a>
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

