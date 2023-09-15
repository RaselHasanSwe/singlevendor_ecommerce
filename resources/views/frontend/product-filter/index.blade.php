@extends('frontend.layout.app')

@section('title') Home @endsection
@section('style')
<style>
.pagination-outer{ text-align: center; }
.pagination{
    font-family: 'Poppins', sans-serif;
    display: inline-flex;
    position: relative;
}
.pagination li a.page-link{
    color: #f9412b;
    background: transparent;
    font-size: 17px;
    font-weight: 600;
    text-align: center;
    line-height: 36px;
    height: 35px;
    width: 35px;
    padding: 0;
    margin: 0 7px;
    border: none;
    border-radius: 5px;
    display: block;
    position: relative;
    z-index: 0;
    transition: all 0.1s ease 0s;
}
.pagination li:first-child a.page-link,
.pagination li:last-child a.page-link{
    font-size: 30px;
    line-height: 33px;
}
.pagination li a.page-link:hover,
.pagination li a.page-link:focus,
.pagination li.active a.page-link:hover,
.pagination li.active a.page-link{
    color: #fff;
    background: #f9412b;
}
.pagination li a.page-link:before,
.pagination li a.page-link:after{
    content: '';
    border-radius: 5px;
    border: 2px solid #555;
    position: absolute;
    left: 0;
    bottom: 0;
    right: 0;
    top: 0;
    z-index: -1;
    transition: all 0.3s ease 0s;
}
.pagination li a.page-link:before{
    border-top-color: transparent;
    border-bottom-color: transparent;
}
.pagination li a.page-link:after{
    border-left-color: transparent;
    border-right-color: transparent;
}
.pagination li a.page-link:hover:before,
.pagination li a.page-link:focus:before,
.pagination li.active a.page-link:hover:before,
.pagination li.active a.page-link:before{
    left: -4px;
    right: -4px;
}
.pagination li a.page-link:hover:after,
.pagination li a.page-link:focus:after,
.pagination li.active a.page-link:hover:after,
.pagination li.active a.page-link:after{
    top: -4px;
    bottom: -4px;
}
@media only screen and (max-width: 480px){
    .pagination{
        font-size: 0;
        display: inline-block;
    }
    .pagination li{
        display: inline-block;
        vertical-align: top;
        margin: 0 0 15px;
    }
}

</style>
@endsection

@section('content')

@include('frontend.product-filter.breadcum')

<!-- page wrapper start -->
<div class="page-main-wrapper">
    <div class="container">
        <div class="row">
            @include('frontend.product-filter.filter')
            <!-- product main wrap start -->
            <div class="col-lg-9 order-1 order-lg-2 set-all-products">
                @include('frontend.product-filter.products')
            </div>
            <!-- product main wrap end -->
        </div>
    </div>
</div>
<!-- page wrapper end -->
@endsection


@section('script') @endsection

