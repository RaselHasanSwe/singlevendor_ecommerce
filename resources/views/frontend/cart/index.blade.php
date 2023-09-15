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
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/shop') }}">shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">cart</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
<!-- cart main wrapper start -->
<div class="cart-main-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Cart Table Area -->
                <div class="cart-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="pro-thumbnail">Thumbnail</th>
                            <th class="pro-title">Product</th>
                            <th class="pro-price">Price</th>
                            <th class="pro-quantity">Quantity</th>
                            <th class="pro-subtotal">Total</th>
                            <th class="pro-remove">Remove</th>
                        </tr>
                        </thead>
                        <tbody class="set-big-cart-item">
                            @include('frontend.__pertials.big-cart')
                        </tbody>
                    </table>
                </div>

                <!-- Cart Update Option -->
                <div class="cart-update-option d-block d-md-flex justify-content-between">
                    <div class="apply-coupon-wrapper">
                        <form id="couponForm" action="{{ route('frontend.coupon.add') }}" method="post" class=" d-block d-md-flex">
                            <input type="text" name="code" placeholder="Enter Your Coupon Code" required />
                            <button type="submit" class="sqr-btn">Apply Coupon</button>
                        </form>
                    </div>
                    <div class="cart-update mt-sm-16">
                        <a href="javascript:;" class="sqr-btn" onclick="updateCartItem('{{ route('frontend.cart.update') }}')">Update Cart</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-5 ml-auto big-cart-total">
                <!-- Cart Calculation Area -->
                @include('frontend.__pertials.big-cart-total')
            </div>
        </div>
    </div>
</div>
<!-- cart main wrapper end -->
@endsection


@section('script') @endsection

