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
                            <li class="breadcrumb-item active" aria-current="page">contact us</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
 <!-- contact area start -->
 <div class="contact-area pb-34 pb-md-18 pb-sm-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-message">
                    <h2>tell us your importent word</h2>
                    <form action="{{ route('frontend.contact-us') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="name" placeholder="Name *" type="text" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="phone" placeholder="Phone *" type="text" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="email" placeholder="Email *" type="email" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="subject" placeholder="Subject *" type="text">
                            </div>
                        <div class="col-12">
                                <div class="contact2-textarea text-center">
                                    <textarea placeholder="Message *" name="message"  class="form-control2" required=""></textarea>
                                </div>
                                <div class="contact-btn">
                                    <button class="sqr-btn" type="submit">Send Message</button>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-info mt-md-28 mt-sm-28">
                    <h2>contact us</h2>
                    <p>{{ $setting->website_contact_us }}</p>
                    <ul>
                        @if($setting->website_address)
                            <li><i class="fa fa-fax"></i> Address : {{ $setting->website_address }}</li>
                        @endif

                        @if($setting->website_email)
                            <li><i class="fa fa-envelope-o"></i> {{ $setting->website_email }}</li>
                        @endif
                        @if($setting->website_phone)
                            <li><i class="fa fa-phone"></i> {{ $setting->website_phone }}</li>
                        @endif
                    </ul>
                    @if($setting->website_working_hours)
                        <div class="working-time">
                            <h3>Working hours</h3>
                            <p>{{ $setting->website_working_hours }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact area end -->

<!-- map area start -->
<div class="map-area-wrapper mb-5">
    <div class="container">
        <div id="map"></div>
    </div>
</div>
<!-- map area end -->
@endsection


@section('script')

@endsection

