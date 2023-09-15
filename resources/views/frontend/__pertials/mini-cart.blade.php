<div class="cart-total-price">
    <span>total</span>
    <small class="set-grand-total">${{ CartService::cartTotal() }}</small>
</div>
<ul class="cart-list">
    @foreach (Cart::content() as $row)
        <li id="{{ $row->rowId }}">
            <div class="cart-img">
                <a href="{{ Str::URI($row->options->slug) }}"><img class="cart-img" src="{{ $row->options->color_image ? ImageViewer::show($row->options->color_image, 'md-') : ImageViewer::show($row->options->image, 'md-') }}"
                        alt=""></a>
            </div>
            <div class="cart-info">
                <h4><a href="{{ Str::URI($row->options->slug) }}">{{ Str::limit($row->name,20) }}</a></h4>
                <span>${{ number_format($row->price, 2) }} x {{ $row->qty }}</span>
            </div>
            <div class="del-icon" onclick="deleteCartItem('{{ $row->rowId }}', '{{ route('frontend.cart.remove') }}')">
                <i class="fa fa-times"></i>
            </div>
        </li>
    @endforeach
    <li class="mini-cart-price">
        <span class="subtotal">subtotal : </span>
        <span class="subtotal-price set-grand-total">${{ CartService::cartTotal() }}</span>
    </li>
    <li class="checkout-btn">
        <a href="{{ route('frontend.cart') }}">Cart</a>
    </li>
</ul>
