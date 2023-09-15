@extends('frontend.layout.app')

@section('title') Home @endsection
@section('style')
    <style>
        .carousel-item{
            max-height: 456px !important;
        }
        .carousel-item img{
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
 <!-- hero slider start -->
 @include('frontend.home.slider')
 <!-- hero slider end -->

 <!-- page content start -->
 <div class="page-wrapper pt-20">
     <div class="container">
         @include('frontend.home.hot-product')
         @include('frontend.home.recomend-product')
     </div>
 </div>
 <!-- page content end -->
@endsection


@section('script') @endsection

