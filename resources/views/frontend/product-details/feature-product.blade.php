<div class="col-lg-3">
    <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
        <!-- featured category start -->
        <div class="sidebar-widget mb-22">
            <div class="section-title-2 d-flex justify-content-between mb-28">
                <h3>featured</h3>
                <div class="category-append"></div>
            </div> <!-- section title end -->
            <div class="category-carousel-active row" data-row="4">
                @if(count($featured_products) > 0)
                    @foreach ($featured_products as $item)
                        <div class="col">
                            <div class="category-item">
                                <div class="category-thumb">
                                    <a href="{{ Str::URI($item->slug) }}">
                                        <img class="img-pri2" src="{{ ImageViewer::show($item->thumbnail, 'md-') }}" alt="">
                                    </a>
                                </div>
                                <div class="category-content">
                                    <h4><a href="{{ Str::URI($item->slug) }}">{{ Str::limit($item->name, 26) }}</a></h4>
                                    <div class="price-box">
                                        <div class="regular-price">
                                            ${{ $item->discount ? Str::Price($item) : $item->price }}
                                        </div>
                                        @if($item->discount)
                                            <div class="old-price">
                                                <del>${{ number_format($item->price,2) }}</del>
                                            </div>
                                        @endif
                                    </div>
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
                            </div> <!-- end single item -->
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- featured category end -->
    </div>
</div>
