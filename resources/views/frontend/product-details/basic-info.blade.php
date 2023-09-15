<div class="col-lg-9">
    <div class="product-details-inner">
        <div class="row">
            <div class="col-lg-6">
                <div class="exzoom" id="exzoom">
                    <div class="exzoom_img_box">
                        <ul class='exzoom_img_ul'>
                            <li><img src="{{ ImageViewer::show($product->thumbnail) }}"/></li>

                            @if(count($product->variations) > 0)
                                @foreach ($product->variations as $color)
                                    <li><img src="{{ ImageViewer::show($color->image) }}"/></li>
                                @endforeach
                            @endif

                            @if(count($product->images))
                                @foreach ($product->images as $img)
                                    <li><img src="{{ ImageViewer::show($img->image) }}"/></li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                    <div class="exzoom_nav"></div>
                    <p class="exzoom_btn">
                        <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                        <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-details-des mt-md-34 mt-sm-34">
                    <h3><a href="product-details.html">{{ $product->name }}</a></h3>
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
                    <div class="customer-rev">
                        <a href="#">(1 customer review)</a>
                    </div>
                    <div class="availability mt-10">
                        <h5>Availability:</h5>
                        <span>{{ $product->stock ? $product->stock.' in stock' : 'out of stock'}}</span>
                    </div>
                    <div class="pricebox">
                        <span class="regular-price">
                            <span id="set_variation_price">${{ $product->discount ? Str::Price($product) : $product->price }}</span>
                            @if($product->discount)
                                <del>${{ number_format($product->price,2) }}</del>
                            @endif
                        </span>
                    </div>
                    <p>{!! $product->sort_description !!}</p>

                    @if(count($product->variations) > 0)
                        <div class="color-option mt-10 has_color get_active_color">
                            <h5>color :</h5>
                            <ul>
                                @foreach ($product->variations as $key => $color)
                                    <li>
                                        <a class="click_color_image" id="{{ $color->color_id }}" href="javascript:;" title="{{ $color->color->name }}">
                                            <img src="{{ ImageViewer::show($color->image, 'md-') }}" color-id="{{ $color->color_id }}" id="img-css" class="img_click_change" index="{{ $key + 1 }}">
                                        </a>
                                    </li>
                                @endforeach
                                <input type="hidden" id="active_color" name="active_color">
                            </ul>
                        </div>
                    @endif

                    @if(count($product->colors) && count($product->variations) < 1)
                        <div class="color-option mt-10 has_color get_active_color">
                            <h5>color :</h5>
                            <ul>
                                @foreach ($product->colors as $color)
                                    <li>
                                        <a class="click_color" id="{{ $color->color->id }}" href="javascript:;" title="{{ $color->color->name }}" style="background: {!! $color->color->color !!}"></a>
                                    </li>
                                @endforeach
                                <input type="hidden" id="active_color" name="active_color">
                            </ul>
                        </div>
                    @endif
                    @if(count($product->sizes))
                        <div class="pro-size mb-20 mt-20 has_size get_active_size">
                            <h5>size :</h5>
                            <select class="nice-select" id="active_size" name="active_size">
                                <option value="">select size</option>
                                @foreach ($product->sizes as $size)
                                    <option value="{{ $size->size->id }}">{{ $size->size->name }} ({{ $size->size->measurement }})</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="quantity-cart-box d-flex align-items-center">
                        <div class="quantity">
                            <div class="pro-qty"><input type="text" id="qty" name="qty" value="1"></div>
                        </div>
                        <div class="action_link">
                            <a class="buy-btn" href="javascript:;" id="add_to_cart_from_product_details">add to cart<i class="fa fa-shopping-cart"></i> </a>
                        </div>
                    </div>
                    <div class="useful-links mt-20">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="fa fa-refresh"></i>compare</a>
                        <a href="javascript:;" onclick="wishlist('{{ $product->id }}')" data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart-o"></i>wishlist</a>
                    </div>
                    <div class="share-icon mt-20">
                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
