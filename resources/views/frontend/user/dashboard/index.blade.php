 <!-- Single Tab Content Start -->
 <div class="tab-pane fade show {{ request()->tab == '' ? 'active' :'' }} {{ request()->tab == 'dashboad' ? 'active' : '' }}" id="dashboad" role="tabpanel">
    <div class="myaccount-content">
        <h3>Dashboard</h3>
        <div class="welcome">
            <p>Hello, <strong>{{ Auth::user()->name }}</strong> </p>
        </div>
        <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping addresses and edit your password and account details.</p>
        <div class="row">
            <div class="col-md-3  mt-3">
                <div class="card-class">
                    <h6>Total Buyed</h6>
                    <h6>${{ number_format($total_buyed, 2) }}</h6>
                </div>
            </div>
            <div class="col-md-3  mt-3">
                <div class="card-class">
                    <h6>Total Pending</h6>
                    <h6>{{ $pending_order }}</h6>
                </div>
            </div>
            <div class="col-md-3  mt-3">
                <div class="card-class">
                    <h6>Total Confirmed</h6>
                    <h6>{{ $confirm_order }}</h6>
                </div>
            </div>
            <div class="col-md-3  mt-3">
                <div class="card-class">
                    <h6>Total Delivered</h6>
                    <h6>{{ $delivered_order }}</h6>
                </div>
            </div>
            <div class="col-md-3  mt-3">
                <div class="card-class">
                    <h6>Total Canceled</h6>
                    <h6>{{ $cancel_order }}</h6>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- Single Tab Content End -->
