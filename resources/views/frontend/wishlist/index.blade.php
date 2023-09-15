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
                            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
 <!-- wishlist main wrapper start -->
 <div class="wishlist-main-wrapper mb-5">
    <div class="container">
        <!-- Wishlist Page Content Start -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Wishlist Table Area -->
                <div class="cart-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="pro-thumbnail">Thumbnail</th>
                            <th class="pro-title">Product</th>
                            <th class="pro-price">Price</th>
                            <th class="pro-quantity">Stock Status</th>
                            <th class="pro-subtotal">Add to Cart</th>
                            <th class="pro-remove">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($wishlist) > 0)
                                @foreach ($wishlist as $item)
                                    <tr id="wishlist-{{ $item->id }}">
                                        <td class="pro-thumbnail">
                                            <a href="{{ Str::URI($item?->products?->slug) }}">
                                                <img class="img-fluid" src="{{ ImageViewer::show($item?->products?->thumbnail, 'md-') }}"
                                                alt="Product"/>
                                            </a>
                                        </td>
                                        <td class="pro-title"><a href="{{ Str::URI($item?->products->slug) }}">{{ Str::limit($item?->products?->name, 50) }}</a></td>
                                        <td class="pro-price">
                                            <span>
                                                ${{ $item?->products?->discount ? Str::Price($item?->products) : $item?->products?->price }}
                                                @if($item?->products?->discount)
                                                    <del>${{ number_format($item?->products?->price,2) }}</del>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="pro-quantity"><span class="{{ $item?->products?->stock > 0 ? 'text-success' : 'text-danger' }} "> {{ $item?->products?->stock > 0 ? 'In Stock' : 'Stock Out' }}</span></td>
                                        @if($item?->products?->sizes === null && $item?->products?->colos === null && count($item?->products?->sizes) < 1 && count($item?->products?->colos) < 1)
                                            <td class="pro-subtotal"><a href="javascript:;" onclick="addToCart('{{ route('frontend.cart.add') }}', '{{ $item?->products?->id }}', 1)" class="sqr-btn text-white">Add to Cart</a></td>
                                        @else
                                        <td class="pro-subtotal"><a href="{{ Str::URI($item?->products?->slug) }}"  class="sqr-btn text-white">Add to Cart</a></td>
                                        @endif
                                        <td class="pro-remove"><a href="javascript:;" onclick="wishlistRemove('{{ $item->id }}')"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No Wishlist Found</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Wishlist Page Content End -->
    </div>
</div>
<!-- wishlist main wrapper end -->
@endsection


@section('script') @endsection

