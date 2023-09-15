 <!-- Single Tab Content Start -->
 <div class="tab-pane fade {{ request()->tab == 'orders' ? 'active' : '' }}" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <h3>Orders</h3>
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->invoice_id }}</td>
                            <td>{{ date('Y-m-d H:i A', strtotime($order->created_at)) }}</td>
                            <td>{{ Str::OrderStatus($order->order_status) }}</td>
                            <td>{{ Str::PaymentStatus($order->payment_status) }}</td>
                            <td>${{ $order->grand_total }}</td>
                            <td>
                                <a href="{{ route('user.order.view', $order->id) }}" class="check-btn sqr-btn ">View</a>
                                <a href="{{ route('user.order.download', $order->id) }}" class="check-btn sqr-btn "><i class="fa fa-cloud-download"></i> Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">NO ORDER FOUND YET</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
        {{ $orders->appends(request()->all())->links() }}
    </div>

</div>
<!-- Single Tab Content End -->
