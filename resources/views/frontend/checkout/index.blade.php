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
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/shop') }}">shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">checkout</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
<!-- checkout main wrapper start -->
<div class="checkout-page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Checkout Login Coupon Accordion Start -->
                <div class="checkoutaccordion" id="checkOutAccordion">
                    <div class="card">
                        <h3>Returning Customer? <span data-toggle="collapse" data-target="#logInaccordion"><a href="{{ route('login') }}?redirect=checkout" class="hlink">Click Here To Login</a></span></h3>
                    </div>

                    <div class="card">
                        <h3>Have A Coupon? <span data-toggle="collapse" data-target="#couponaccordion"><a href="{{ route('frontend.cart') }}" class="hlink">Click Here To Enter Your Code</a></span></h3>
                    </div>
                </div>
                <!-- Checkout Login Coupon Accordion End -->
            </div>
        </div>
        <span class="shipping-error-msg"></span>

        <div class="row mb-5">
            <!-- Checkout Billing Details -->

            <input type="hidden" name="shipping_url" id="shipping_url" value="{{ route('frontend.checkout.shipping') }}">
            <div class="col-lg-6">
                <div class="checkout-billing-details-wrap">
                    <h2>Shipping Details</h2>
                    <div class="billing-form-wrap">
                        <form action="{{ route('frontend.checkout') }}" method="post" id="checkoutForm">
                            @csrf
                            <input type="hidden" name="payment_method" id="payment_method">
                            <div class="single-input-item">
                                <label for="country_from" class="required">Where are you from <span class="required-1">(required)</span></label>
                                <select name="shipping_id" class="nice-select" id="country_from">
                                    <option value="">select where are you</option>
                                    @foreach ($shipping as $item)
                                        <option value="{{ $item->id }}" {{ Session::has('ex_shipping_id') && Session::get('ex_shipping_id') == $item->id ? 'selected' : ''  }}   >{{ Str::ShipTo($item->ship_to, $admin->city) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="f_name" class="required">First Name <span class="required-1">(required)</span></label>
                                        <input type="text" id="f_name" placeholder="First Name" name="first_name" value="{{ @$ex_shipping->first_name }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="l_name">Last Name</label>
                                        <input type="text" id="l_name" placeholder="Last Name" name="last_name" value="{{ @$ex_shipping->last_name }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" placeholder="Email Address" name="email" value="{{ @$ex_shipping->email }}" />
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="country">Country</label>
                                        <input type="text" id="country"  placeholder="Country" name="country" value="{{ @$ex_shipping->country }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="town">Town / City</label>
                                        <input type="text" id="town"  placeholder="Town / City" name="city" value="{{ @$ex_shipping->city }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="state">State / Divition</label>
                                        <input type="text" id="state"  placeholder="State / Divition" name="state" value="{{ @$ex_shipping->state }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="postcode">Postcode / ZIP</label>
                                        <input type="text" id="postcode"  placeholder="Postcode / ZIP" name="zip" value="{{ @$ex_shipping->zip }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <label for="phone" class="required">Phone <span class="required-1">(required)</span></label>
                                <input type="text" id="phone"  placeholder="Phone" name="phone" value="{{ @$ex_shipping->phone }}" />
                            </div>

                            <div class="single-input-item">
                                <label for="street-address" class="required pt-20">Street address <span class="required-1">(required)</span></label>
                                <input type="text" id="street-address" placeholder="Street address Line 1" name="address_1" value="{{ @$ex_shipping->address_1 }}" />
                            </div>

                            <div class="single-input-item">
                                <input type="text"  placeholder="Street address Line 2 (Optional)" name="address_2" value="{{ @$ex_shipping->address_2 }}" />
                            </div>
                            <div class="checkout-box-wrap">
                                <div class="single-input-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input new_account"  id="create_pwd" name="new_account">
                                        <label class="custom-control-label" for="create_pwd">Create an account?</label>
                                    </div>
                                </div>
                                <div class="account-create single-form-row">
                                    <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                    <div class="single-input-item">
                                        <label for="pwd" class="required">Account Password</label>
                                        <input type="password" id="pwd"  placeholder="Account Password" name="password" />
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <label for="ordernote">Order Note</label>
                                <textarea name="order_note" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary Details -->
            <div class="col-lg-6">
                <div class="order-summary-details mt-md-26 mt-sm-26">
                    <h2>Your Order Summary</h2>
                    <div class="order-summary-content mb-sm-4">
                        <!-- Order Summary Table -->
                        <div class="order-summary-table table-responsive text-center set-order-summary">
                            @include('frontend.__pertials.checkout-order-summary')
                        </div>
                        <!-- Order Payment Method -->
                        <div class="order-payment-method">
                            <div class="single-payment-method show">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="cashon" name="paymentmethod" value="1" class="custom-control-input common_payment" checked  />
                                        <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="cash">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>

                            <div class="single-payment-method">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="paypalpayment" name="paymentmethod" value="3" class="custom-control-input common_payment" />
                                        <label class="custom-control-label" for="paypalpayment">Pay with Paypal <img src="{{ asset('frontend_assets/assets/img/paypal-card.jpg')}}" class="img-fluid paypal-card" alt="Paypal" /></label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="paypal">
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                </div>
                            </div>
                            <div class="single-payment-method">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="stripepayment" name="paymentmethod" value="4" class="custom-control-input common_payment" />
                                        <label class="custom-control-label" for="stripepayment">Pay with Stripe <img src="{{ asset('frontend_assets/assets/img/paypal-card.jpg')}}" class="img-fluid paypal-card" alt="Stripe" /></label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="paypal">
                                    <p>Pay via Stripe; you can pay with your credit card if you don’t have a Stripe account.</p>
                                </div>
                            </div>


                            <div class="summary-footer-area">
                                <div class="custom-control custom-checkbox mb-14">
                                    <input type="checkbox" class="custom-control-input" id="terms" required />
                                    <label class="custom-control-label" for="terms">I have read and agree to the website <a
                                        href="{{ route('frontend.terms-conditions') }}" style="color: #d8373e">terms and conditions.</a></label>
                                </div>
                                <button type="submit" id="place_order_btn" class="check-btn sqr-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout main wrapper end -->
@endsection


@section('script')
<script>
    $(document).on('click', '.payment-method-name', function(){
        let method = $(this).find('.common_payment').val();
        $('#payment_method').val(method);
    })
    $(document).on('click', '#place_order_btn', function(){
        $('#checkoutForm').submit();
    });
    $(document).on('submit', '#checkoutForm', function(event){
        // event.preventDefault();
        let shipping_id = $("select[name=shipping_id]").val();
        let first_name = $("input[name=first_name]").val();
        let phone = $("input[name=phone]").val();
        let address_1 = $("input[name=address_1]").val();

        if(shipping_id == ''){
            toastr.error('Please Select Where Are You From', 'Error!')
            return false;
        }
        if(first_name == ''){
            toastr.error('Please Enter Your First Name', 'Error!')
            return false;
        }
        if(phone == ''){
            toastr.error('Please Enter Your Phone Number', 'Error!')
            return false;
        }
        if(address_1 == ''){
            toastr.error('Please Enter Your Address', 'Error!')
            return false;
        }
        if($('.new_account').prop('checked') == true){
            let email = $("input[name=email]").val();
            let password = $("input[name=password]").val();
            if(email == ''){
                toastr.error('Please Enter Your Email Address', 'Error!')
                return false;
            }
            if(password == ''){
                toastr.error('Please Enter Your Password', 'Error!')
                return false;
            }
            if(password.trim().length < 8){
                toastr.error('Password Must Be More Then or Equal 8 Character', 'Error!')
                return false;
            }
        }

        if($('#terms').prop('checked') != true){
            toastr.error('Please read and select Terms and Condition', 'Error!')
            return false;
        }

    })
</script>
@endsection

