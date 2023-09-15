<div class="cart-calculator-wrapper">
    <div class="cart-calculate-items">
        <h3>Cart Totals</h3>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>Sub Total</td>
                    <td>${{ $cart_total['cart_total'] }}</td>
                </tr>
                @if($cart_total['coupon_total'] > 0)
                    <tr>
                        <td>Coupon Amount</td>
                        <td>- ${{ $cart_total['coupon_total'] }}</td>
                    </tr>
                @endif
                <tr class="total">
                    <td>Total</td>
                    <td class="total-amount">${{ number_format(str_replace(',','', $cart_total['cart_total']) - $cart_total['coupon_total'], 2) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <a href="{{ route('frontend.checkout') }}" class="sqr-btn d-block">Proceed To Checkout</a>
</div>
