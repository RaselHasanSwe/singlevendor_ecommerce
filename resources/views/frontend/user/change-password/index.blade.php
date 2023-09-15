<!-- Single Tab Content Start -->
<div class="tab-pane fade {{ request()->tab == 'change-password' ? 'active' : '' }}" id="change-password" role="tabpanel">
    <div class="myaccount-content">
        <h3>Change Password</h3>
        <div class="account-details-form mt-5">
            <form action="{{ route('user.change-password') }}" method="post">
                @csrf
                <div class="single-input-item">
                    <label for="current-pwd" class="required">Current Password</label>
                    <input type="password" name="current_password" id="current-pwd" placeholder="Current Password" required />
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if(Session::has('change_pass_error'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ Session::get('change_pass_error') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="new-pwd" class="required">New Password</label>
                            <input type="password" name="password" id="new-pwd" placeholder="New Password" required />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="confirm-pwd" class="required">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="confirm-pwd" placeholder="Confirm Password" required />
                        </div>
                    </div>
                </div>
                <div class="single-input-item">
                    <button class="check-btn sqr-btn ">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- Single Tab Content End -->
