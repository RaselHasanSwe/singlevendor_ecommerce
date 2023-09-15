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
                            <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
 <!-- login register wrapper start -->
 <div class="login-register-wrapper">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <div class="col-lg-3"></div>
                <!-- Register Content Start -->
                <div class="col-lg-6 mb-5">
                    <div class="login-reg-form-wrap mt-md-34 mt-sm-34">
                        <h2 class="text-center login-form-head">Reset Password</h2>
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="single-input-item">
                                <input type="email" placeholder="Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <button class="sqr-btn ">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register Content End -->
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
</div>
<!-- login register wrapper end -->
@endsection


@section('script') @endsection

