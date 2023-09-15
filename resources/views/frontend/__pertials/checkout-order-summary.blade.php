<table class="table table-bordered">
    <thead>
        <tr>
            <th>Products</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach (Cart::content() as $row)
            <tr>
                <td><a href="single-product.html">{{ Str::limit($row->name,30) }} <strong> × {{ $row->qty }}</strong></a></td>
                <td>${{ number_format($row->price * $row->qty, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    @php $totalDetails = CartService::cartTotalWithAditional(); @endphp

    <tfoot>
        <tr>
            <td>Sub Total</td>
            <td><strong>${{ $totalDetails['cart_total'] }}</strong></td>
        </tr>
        @if($totalDetails['coupon_total'] > 0)
        <tr>
            <td>Coupon Amount</td>
            <td><strong> - ${{ $totalDetails['coupon_total'] }}</strong></td>
        </tr>
        @endif
        <tr>
            <td>Shipping Amount</td>
            <td><strong>${{ CartService::shippingTotal() }}</strong></td>
        </tr>
        <tr>
            <td>Total Amount</td>
            <td><strong>${{ number_format(Str::number($totalDetails['cart_total']) -  Str::number($totalDetails['coupon_total']) + Str::number(CartService::shippingTotal()), 2) }}</strong></td>
        </tr>
    </tfoot>
</table>
