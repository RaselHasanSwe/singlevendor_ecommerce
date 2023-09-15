<footer>
    <!-- footer top start -->
    <div class="footer-top bg-black pt-14 pb-14">
        <div class="container">
            <div class="footer-top-wrapper">
                <div class="newsletter__wrap">
                    <div class="newsletter__title">
                        <div class="newsletter__icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="newsletter__content">
                            <h3>sign up for newsletter</h3>
                            <p>Duis autem vel eum iriureDuis autem vel eum</p>
                        </div>
                    </div>
                    <div class="newsletter__box">
                        <form id="mc-form-submit">
                            <input type="email" id="mc-email" autocomplete="off" placeholder="Email">
                            <button id="mc-submit">subscribe!</button>
                        </form>
                    </div>
                    <!-- mailchimp-alerts Start -->
                    <div class="mailchimp-alerts">
                        <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                        <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                        <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                    </div>
                    <!-- mailchimp-alerts end -->
                </div>
                <div class="social-icons">
                    <a href="{{ $setting->fb }}" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="{{ $setting->tw }}" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <a href="{{ $setting->ins }}" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                    <a href="{{ $setting->gp }}" data-toggle="tooltip" data-placement="top" title="Google-plus"><i class="fa fa-google-plus"></i></a>
                    <a href="{{ $setting->yt }}" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- footer top end -->

    <!-- footer main start -->
    <div class="footer-widget-area pt-40 pb-38 pb-sm-10">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>contact us</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="location">
                                @if($setting->website_email)
                                    <li><i class="fa fa-envelope"></i>{{ $setting->website_email }}</li>
                                @endif
                                @if($setting->website_phone)
                                    <li><i class="fa fa-phone"></i>{{ $setting->website_phone }}</li>
                                @endif
                                @if($setting->website_address)
                                    <li><i class="fa fa-map-marker"></i>{{ $setting->website_address }}</li>
                                @endif
                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>my account</h4>
                        </div>
                        <div class="widget-body">
                            <ul>
                                <li><a href="{{ url('shop') }}">my shop</a></li>
                                <li><a href="{{ route('home') }}">my account</a></li>
                                <li><a href="{{ route('frontend.cart') }}">my cart</a></li>
                                <li><a href="{{ route('frontend.checkout') }}">checkout</a></li>
                                <li><a href="{{ route('wishlist') }}">my wishlist</a></li>
                                <li><a href="{{ route('login') }}">login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>Shop Now</h4>
                        </div>
                        <div class="widget-body">
                            <ul>
                                @if(count($headerCategories) > 0)
                                    @foreach ($headerCategories as $item)
                                        <li><a href="{{ 'shop/'.$item->slug }}">{{ $item->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>Help & FAQs</h4>
                        </div>
                        <div class="widget-body">
                            <ul>
                                <li><a href="{{ route('frontend.contact-us') }}">Contact Us</a></li>
                                <li><a href="{{ route('frontend.about-us') }}">About Us</a></li>
                                <li><a href="{{ route('frontend.faq') }}">FAQs</a></li>
                                <li><a href="{{ route('frontend.privacy-policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('frontend.terms-conditions') }}">Terms & Conditions</a></li>
                                <li><a href="{{ route('frontend.cookies-policy') }}">Cookies Policy</a></li>
                                <li><a href="{{ route('frontend.return-policy') }}">Return Policy</a></li>
                                <li><a href="{{ route('frontend.disclaimer') }}">Disclaimer</a></li>

                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
            </div>
        </div>
    </div>
    <!-- footer main end -->

    <!-- footer bootom start -->
    <div class="footer-bottom-area bg-red pt-20 pb-20">
        <div class="container">
            <div class="footer-bottom-wrap">
                <div class="copyright-text">
                    <p><a target="_blank" href="">&copy; devexperts.com All rights reserved. </a></p>
                </div>
                <div class="payment-method-img">
                    <img src="{{ asset('frontend_assets/assets/img/payment.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- footer bootom end -->

</footer>
