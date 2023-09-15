<div class="col-lg-12">
    <!-- related products area start -->
    <div class="related-products-area mt-34 mb-5">
        <div class="section-title mb-30">
            <div class="title-icon">
                <i class="fa fa-desktop"></i>
            </div>
            <h3>related products</h3>
        </div> <!-- section title end -->
        <!-- featured category start -->
        <div class="featured-carousel-active slick-padding slick-arrow-style">
            <!-- product single item start -->
            @if(count($related_products) > 0)
                @foreach ($related_products as $item)
                    <div class="product-item fix">
                        <div class="product-thumb">
                            <a href="{{ Str::URI($item->slug) }}">
                                <img src="{{ ImageViewer::show($item->thumbnail, 'md-') }}" class="img-pri-shop" alt="">
                            </a>
                            @if($item->discount)
                                <div class="product-label-small">
                                    <span>-{{ $item->discount }}{{ $item->discount_type == 1 ? '%' : '$' }}</span>
                                </div>
                            @endif
                            <div class="product-action-link">
                                <a href="{{ Str::URI($item->slug) }}" data-toggle="tooltip" data-placement="left" title="Quick view">
                                    <i class="fa fa-search"></i>
                                </a>

                                <a href="javascript:;" onclick="wishlist('{{ $item->id }}')" data-toggle="tooltip" data-placement="left" title="Wishlist">
                                    <i class="fa fa-heart-o"></i>
                                </a>
                                @if($item->sizes === null && $item->colos === null && count($item->sizes) < 1 && count($item->colos) < 1)
                                    <a href="javascript:;" onclick="addToCart('{{ route('frontend.cart.add') }}', '{{ $item->id }}', 1)" data-toggle="tooltip" data-placement="left" title="Add to cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                @else
                                    <a href="{{ Str::URI($item->slug) }}" data-toggle="tooltip" data-placement="left" title="Add to cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="product-content">
                            <h4><a href="{{ Str::URI($item->slug) }}">{{ Str::limit($item->name, 26) }}</a></h4>
                            <div class="pricebox">
                                <span class="regular-price">
                                    ${{ $item->discount ? Str::Price($item) : $item->price }}
                                    @if($item->discount)
                                        <del>${{ number_format($item->price,2) }}</del>
                                    @endif
                                </span>
                                <div class="ratings">
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span class="good"><i class="fa fa-star"></i></span>
                                    <span><i class="fa fa-star"></i></span>
                                    <div class="pro-review">
                                        <span>1 review(s)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- product single item end -->
        </div>
        <!-- featured category end -->
    </div>
    <!-- related products area end -->
</div>
