 <!-- Single Tab Content Start -->
 <div class="tab-pane fade {{ request()->tab == 'shipping-address' ? 'active' : '' }}" id="shipping-address" role="tabpanel">
    <div class="myaccount-content">
        <h3>Shipping Address</h3>
        <form action="{{ route('user.update-shipping') }}" method="post" id="shippingForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="single-input-item">
                        <label for="f_name" class="required">First Name</label>
                        <input type="text" value="{{ old('first_name') ? old('first_name') : @$shipping_info->first_name }}" id="f_name" placeholder="First Name" name="first_name" required />
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-input-item">
                        <label for="l_name" class="required">Last Name</label>
                        <input type="text" value="{{ old('last_name') ? old('last_name') : @$shipping_info->last_name }}" id="l_name" placeholder="Last Name" name="last_name" required />
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="single-input-item">
                <label for="email" class="required">Email Address</label>
                <input type="email" value="{{ old('email') ? old('email') : @$shipping_info->email }}" id="email" placeholder="Email Address" name="email" required />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="single-input-item">
                        <label for="country" class="required">Country</label>
                        <input type="text" value="{{ old('country') ? old('country') :  @$shipping_info->country }}" id="country"  placeholder="Town / City" name="country" required />
                        @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single-input-item">
                        <label for="town" class="required">Town / City</label>
                        <input type="text" id="town" value="{{ old('city') ? old('city') :  @$shipping_info->city }}"  placeholder="Town / City" name="city" required />
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-input-item">
                        <label for="state">State / Divition</label>
                        <input type="text" id="state" value="{{ old('state') ? old('state') : @$shipping_info->state }}"  placeholder="State / Divition" name="state" required />
                        @error('state')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-input-item">
                        <label for="postcode" class="required">Postcode / ZIP</label>
                        <input type="text" id="postcode" value="{{ old('zip') ? old('zip') : @$shipping_info->zip }}"  placeholder="Postcode / ZIP" name="zip" required />
                        @error('zip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="single-input-item">
                <label for="phone">Phone</label>
                <input type="text" id="phone" value="{{ old('phone') ? old('phone') : @$shipping_info->phone }}"  placeholder="Phone" name="phone" required />
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="single-input-item">
                <label for="street-address" class="required pt-20">Street address</label>
                <input type="text" id="street-address" value="{{ old('address_1') ? old('address_1') : @$shipping_info->address_1 }}" placeholder="Street address Line 1" name="address_1" required />
                @error('address_1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="single-input-item">
                <input type="text"  placeholder="Street address Line 2 (Optional)" name="address_2" value="{{ old('address_2') ? old('address_2') : @$shipping_info->address_2 }}" />
            </div>
            <div class="single-input-item">
                <button class="check-btn sqr-btn ">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<!-- Single Tab Content End -->
