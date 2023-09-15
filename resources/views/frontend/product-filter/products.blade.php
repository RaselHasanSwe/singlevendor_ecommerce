<!-- product view wrapper area start -->
<div class="shop-product-wrapper">
    <div class="shop-top-bar">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <div class="top-bar-left">
                    <div class="product-view-mode mr-sm-0">
                        <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                    </div>

                    <div class="product-amount">
                        @if($products->total() > 20)
                            <p>Showing {{ (($products->currentPage() - 1 ) * $products->perPage()) + 1  }}  – {{ $products->currentPage() * $products->perPage() }} of {{ $products->total() }} results</p>
                        @else
                            @if ($products->total() == 0)
                                <p>Showing 0  – 0 of 0 results</p>
                            @else
                                <p>Showing 1  – {{ $products->total() }} of {{ $products->total() }} results</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="top-bar-right">
                    <div class="product-short">
                        <p>Sort By : </p>
                        <select class="nice-select" id="sort_by" name="sort_by" onchange="makeFilter()">
                            <option value="asc" {{ request()->sort_by == 'asc' ? 'selected' : '' }}>Price (Low &gt; High)</option>
                            <option value="desc" {{ request()->sort_by == 'desc' ? 'selected' : '' }}>Price (High &gt; Low)</option>
                            <option value="name_asc" {{ request()->sort_by == 'name_asc' ? 'selected' : '' }}>Name (A - Z)</option>
                            <option value="name_desc" {{ request()->sort_by == 'name_desc' ? 'selected' : '' }}>Name (Z - A)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop product top wrap start -->

    <!-- product item start -->
    <div class="shop-product-wrap grid row">
        @forelse($products as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-item fix mb-30">
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
            </div>
        @empty
            <img src="{{ asset('frontend_assets/assets/img/no_result.gif') }}" class="img-fluid">
        @endforelse
    </div>
</div>
<!-- product view wrapper area end -->

<!-- start pagination area -->
<div class="demo">
    <nav class="pagination-outer mb-5" aria-label="Page navigation">
        {{ $products->appends(request()->except(['page','_token']))->links() }}
    </nav>
</div>
<!-- end pagination area -->
