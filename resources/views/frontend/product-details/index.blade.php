@extends('frontend.layout.app')

@section('title') Home @endsection
@section('style')
<link href="{{ asset('frontend_assets/assets/zoom/jquery.exzoom.css')}}" rel="stylesheet">
<style>
    .product-details-des .pro-size .nice-select{
        width: 80% !important;
    }
    .activec{
        border: 1px solid red;
    }
    #img-css{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')

<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/shop') }}">shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->


<!-- product details wrapper start -->
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
            <input type="hidden" name="cart_url" id="cart_url" value="{{ route('frontend.cart.add') }}">
            <input type="hidden" name="variation_url" id="variation_url" value="{{ route('frontend.product.variation.check') }}">

            <!-- product details inner end -->
            @include('frontend.product-details.basic-info')
            <!-- product details inner end -->

            <!-- sidebar start -->
            @include('frontend.product-details.feature-product')
            <!-- sidebar end -->

            @include('frontend.product-details.description')

           @include('frontend.product-details.related-product')

        </div>
    </div>
</div>
<!-- product details wrapper end -->
 <!-- page content end -->
@endsection


@section('script')
<script src="{{ asset('frontend_assets/assets/zoom/jquery.exzoom.js')}}"></script>
<script>
    $(function(){
        $("#exzoom").exzoom({

        // thumbnail nav options
        "navWidth": 90,
        "navHeight": 90,
        "navItemNum": 4,
        "navItemMargin": 7,
        "navBorder": 1,

        // autoplay
        "autoPlay": false,

        // autoplay interval in milliseconds
        "autoPlayTimeout": 2000

        });
});
</script>



@endsection

