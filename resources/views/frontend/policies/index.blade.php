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
                            <li class="breadcrumb-item active" aria-current="page">{{ @$tab }}</li>
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
                <div class="col-lg-12">
                    {!! @$item !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login register wrapper end -->
@endsection


@section('script') @endsection

