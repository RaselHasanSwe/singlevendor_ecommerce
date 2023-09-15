<header>
    <!-- header top start -->
    <div class="header-top-area bg-red text-center text-md-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="header-call-action">
                        @if($setting->website_email)
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                {{ $setting->website_email }}
                            </a>
                        @endif
                        @if($setting->website_phone)
                            <a href="#">
                                <i class="fa fa-phone"></i>
                                {{ $setting->website_phone }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="header-top-right float-md-right float-none">
                        <nav>
                            <ul>
                                @if(Auth::guard('web')->check())
                                    <li>
                                        <a href="{{ route('home') }}">My Account</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('wishlist') }}">My Wishlist</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">Register</a>
                                    </li>

                                @endif

                                <li>
                                    <a href="{{ route('frontend.cart') }}">My Cart</a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.checkout') }}">Checkout</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top end -->

    <!-- header middle start -->
    <div class="header-middle-area pt-20 pb-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    @if($setting->website_logo)
                        <div class="brand-logo">
                            <a href="{{ route('frontend.home') }}">
                                <img src="{{ ImageViewer::show($setting->website_logo)}}" alt="brand logo">
                            </a>
                        </div>
                    @endif
                </div> <!-- end logo area -->
                <div class="col-lg-9">
                    <div class="header-middle-right">
                        <div class="header-middle-shipping mb-20">
                            @if($setting->section_1_title || $setting->section_1_sort_title)
                                <div class="single-block-shipping">
                                    @if($setting->section_1_icon)
                                        <div class="shipping-icon">
                                            <i class="{!! $setting->section_1_icon !!}"></i>
                                        </div>
                                    @endif
                                    <div class="shipping-content">
                                        @if($setting->section_1_title) <h5>{{ $setting->section_1_title }}</h5> @endif
                                        @if($setting->section_1_sort_title) <span>{{ $setting->section_1_sort_title }}</span> @endif
                                    </div>
                                </div>
                            @endif

                            @if($setting->section_2_title || $setting->section_2_sort_title)
                                <div class="single-block-shipping">
                                    @if($setting->section_2_icon)
                                        <div class="shipping-icon">
                                            <i class="{!! $setting->section_2_icon !!}"></i>
                                        </div>
                                    @endif
                                    <div class="shipping-content">
                                        @if($setting->section_2_title) <h5>{{ $setting->section_2_title }}</h5> @endif
                                        @if($setting->section_2_sort_title) <span>{{ $setting->section_2_sort_title }}</span> @endif
                                    </div>
                                </div>
                            @endif

                            @if($setting->section_3_title || $setting->section_3_sort_title)
                                <div class="single-block-shipping">
                                    @if($setting->section_3_icon)
                                        <div class="shipping-icon">
                                            <i class="{!! $setting->section_3_icon !!}"></i>
                                        </div>
                                    @endif
                                    <div class="shipping-content">
                                        @if($setting->section_3_title) <h5>{{ $setting->section_3_title }}</h5> @endif
                                        @if($setting->section_3_sort_title) <span>{{ $setting->section_3_sort_title }}</span> @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="header-middle-block">

                            <div class="header-middle-searchbox">
                                <form method="get" action="{{ url('/shop') }}">
                                    <input type="text" placeholder="Search..." name="key" value="{{ request()->key }}">
                                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>

                            <div class="header-mini-cart">
                                <div class="mini-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="cart-notification set-total-item">{{ Cart::content()->count() }}</span>
                                </div>
                                <span class="set-cart-list">
                                    @include('frontend.__pertials.mini-cart')
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header middle end -->

    <!-- main menu area start -->
    <div class="main-header-wrapper bdr-bottom1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-header-inner">
                        <div class="category-toggle-wrap">
                            <div class="category-toggle">
                                category
                                <div class="cat-icon">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <nav class="category-menu hm-1" style="{{ Request::routeIs('frontend.home') ? '' : 'display:none' }}">
                                <ul>
                                    @if(count($headerCategories))
                                        @foreach ($headerCategories as $category)
                                            <li class="{{ count($category->subCategory) > 0 ? 'menu-item-has-children' : ''}}">
                                                <a href="{{ Str::URI('shop/'.$category->slug) }}">
                                                    {!! $category->icon !!} {{ $category->name }}
                                                </a>
                                                @if(count($category->subCategory) > 0)
                                                    <ul class="category-mega-menu">
                                                        @foreach ($category->subCategory as $sub_category)
                                                            <li class="{{ count($sub_category->innerCategory) > 0 ? 'menu-item-has-children' : ''}}">
                                                                <a href="{{ Str::URI('shop/'.$category->slug, $sub_category->slug) }}">{{ $sub_category->name }}</a>
                                                                @if(count($sub_category->innerCategory) > 0)
                                                                    <ul>
                                                                        @foreach ($sub_category->innerCategory as $inner_category)
                                                                            <li><a href="{{ Str::URI('shop/'.$category->slug, $sub_category->slug, $inner_category->slug) }}">{{ $inner_category->name }}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul><!-- Mega Category Menu End -->
                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                                        <a href="{{ route('frontend.home') }}"><i class="fa fa-home"></i>Home</a>
                                    </li>
                                    <li class="{{ request()->routeIs('frontend.shop') ? 'active' : '' }}">
                                        <a href="{{ url('/shop') }}">Shop</a>
                                    </li>
                                    @if(count($main_menu) > 0)
                                        @foreach ($main_menu as $menu)
                                            <li class="">
                                                <a href="{{ url($menu->slug) }}">{{ $menu->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- main menu area end -->

</header>
