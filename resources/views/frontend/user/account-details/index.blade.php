<!-- Single Tab Content Start -->
<div class="tab-pane fade {{ request()->tab == 'account-info' ? 'active' : '' }}" id="account-info" role="tabpanel">
    <div class="myaccount-content">
        <h3>Account Details</h3>
        <div class="account-details-form">
            <form action="{{ route('user.update-account') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="first-name" class="required">First Name</label>
                            <input type="text" value="{{ $account_info->name }}" name="first_name" id="first-name" placeholder="First Name" required />
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="last-name" class="required">Last Name</label>
                            <input type="text" value="{{ $account_info->last_name }}" name="last_name" id="last-name" placeholder="Last Name" />
                        </div>
                    </div>
                </div>
                <div class="single-input-item">
                    <label for="email" class="required">Email Addres</label>
                    <input type="email"  value="{{ $account_info->email }}" name="email" id="email" placeholder="Email Address" required />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="single-input-item">
                    <label for="phone" class="required">Phone</label>
                    <input type="text" name="phone"  value="{{ $account_info->phone }}" id="phone" placeholder="Phone" required />
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="single-input-item">
                    <label for="address" class="required">Address</label>
                    <input type="text" value="{{ $account_info->address }}" name="address" id="address" placeholder="Address" />
                </div>
                <div class="single-input-item">
                    <button class="check-btn sqr-btn ">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- Single Tab Content End -->
