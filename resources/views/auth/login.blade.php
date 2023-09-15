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
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
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
                <div class="col-lg-3"></div>
                <!-- Login Content Start -->
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap  pr-lg-50">
                        <h2 class="login-form-head">Sign In</h2>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="single-input-item">
                                <input type="email" class="@error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="single-input-item">
                                <input type="password"  class="@error('password') is-invalid @enderror" name="password" placeholder="Enter your Password" required />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="single-input-item">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                        </div>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forget-pwd">Forget Password?</a>
                                    @endif
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button class="sqr-btn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login Content End -->

                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
</div>
<!-- login register wrapper end -->
@endsection


@section('script') @endsection

