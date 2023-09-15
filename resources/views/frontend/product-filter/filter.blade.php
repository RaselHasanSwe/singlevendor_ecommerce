 <!-- sidebar start -->
 <div class="col-lg-3 order-2 order-lg-1">
    <div class="shop-sidebar-wrap mt-md-28 mt-sm-28">
        <!-- sidebar categorie start -->
        @if(isset($filter_categories) && count($filter_categories) > 0)
            <div class="sidebar-widget mb-30">
                <div class="sidebar-category">
                    <ul>
                        <li class="title"><i class="fa fa-bars"></i> categories</li>
                        @foreach ($filter_categories as $f_category)
                            <li><a href="{{ Str::CatFilterUrl($f_category) }}">{{ Str::limit($f_category->name, 30) }}</a><span>({{ $f_category->product_count }})</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <!-- sidebar categorie start -->
        <form action="post" method="post" id="filter_form">
            @csrf

            <input type="hidden" name="key" value="{{ request()->key }}">
            <!-- manufacturer start -->
            @if(isset($filter_brands) && count($filter_brands) > 0)
                <div class="sidebar-widget mb-30">
                    <div class="sidebar-title mb-10">
                        <h3>Manufacturers</h3>
                    </div>
                    <div class="sidebar-widget-body">
                        <ul>
                            @foreach ($filter_brands as $brand)
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <a href="javascript:;">
                                        <div class="form-check form-switch" onclick="makeFilter()">
                                            <input class="form-check-input" name="brands[]" value="{{ $brand->id }}" type="checkbox" id="flexSwitchCheckDefault-b{{ $brand->id }}"
                                                {{ request()->brands !== null && count(request()->brands) > 0 && in_array($brand->id, request()->brands) ? 'checked' : ''  }}
                                            >
                                            <label class="form-check-label" for="flexSwitchCheckDefault-b{{ $brand->id }}">{{ $brand->name }}</label>
                                        </div>
                                    </a>
                                    <span>({{ $brand->product_count }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <!-- manufacturer end -->

            <!-- pricing filter start -->
            @if(isset($filter_price_list) && count($filter_price_list) > 0)
                <div class="sidebar-widget mb-30">
                    <div class="sidebar-title mb-10">
                        <h3>filter by price</h3>
                    </div>
                    <div class="sidebar-widget-body">
                        <ul>
                            @foreach ($filter_price_list as $key => $p_list)
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <a href="javascript:;">
                                        <div class="form-check" onclick="makeFilter()">
                                            <input class="form-check-input" type="radio" value="{{ $key }}-{{ $p_list }}" name="price_range" id="flexRadioDefault{{ $key }}"
                                            {{ request()->price_range == $key.'-'.$p_list ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="flexRadioDefault{{ $key }}">
                                                ${{ number_format($key,2) }} - ${{ number_format($p_list,2) }}
                                            </label>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <!-- pricing filter end -->

            <!-- product size start -->
            @if(isset($filter_sizes) && count($filter_sizes) > 0)
                <div class="sidebar-widget mb-30">
                    <div class="sidebar-title mb-10">
                        <h3>size</h3>
                    </div>
                    <div class="sidebar-widget-body">
                        <ul>
                            @foreach ($filter_sizes as $f_size)
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <a href="javascript:;">
                                        <div class="form-check form-switch" onclick="makeFilter()">
                                            <input class="form-check-input" name="sizes[]" value="{{ $f_size->id }}" type="checkbox" id="flexSwitchCheckDefault-s{{ $f_size->id }}"
                                            {{ request()->sizes !== null && count(request()->sizes) > 0 && in_array($f_size->id, request()->sizes) ? 'checked' : ''  }}
                                            >
                                            <label class="form-check-label" for="flexSwitchCheckDefault-s{{ $f_size->id }}">{{ $f_size->name }} ({{ $f_size->measurement }})</label>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <!-- product size end -->

            <!-- product Color start -->
            @if(isset($filter_colors) && count($filter_colors) > 0)
                <div class="sidebar-widget mb-30">
                    <div class="sidebar-title mb-10">
                        <h3>color</h3>
                    </div>
                    <div class="sidebar-widget-body">
                        <ul>
                            @foreach ($filter_colors as $f_color)
                                <li>
                                    <i class="fa fa-angle-right"></i>
                                    <a href="javascript:;">
                                        <div class="form-check form-switch" onclick="makeFilter()">
                                            <input class="form-check-input" name="colors[]" value="{{ $f_color->id }}" type="checkbox" id="flexSwitchCheckDefault-c{{ $f_color->id }}"
                                            {{ request()->colors !== null && count(request()->colors) > 0 && in_array($f_color->id, request()->colors) ? 'checked' : ''  }}
                                            >
                                            <label class="form-check-label" for="flexSwitchCheckDefault-c{{ $f_color->id }}">{{ $f_color->name }}</label>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <!-- product Color end -->
        </form>
    </div>
</div>
<!-- sidebar end -->
