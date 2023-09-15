@foreach (Cart::content() as $row)
<tr id="big-{{ $row->rowId }}">
    <td class="pro-thumbnail">
        <a href="{{ Str::URI($row->options->slug) }}">
            <img class="img-fluid" src="{{ $row->options->color_image ? ImageViewer::show($row->options->color_image, 'md-') : ImageViewer::show($row->options->image, 'md-') }}" alt="Product"/>
        </a>
    </td>
    <td class="pro-title">
        <a href="{{ Str::URI($row->options->slug) }}">
            {{ Str::limit($row->name,100) }}<br/>
            {{ $row->options?->size ? 'Size: '.$row->options?->size :'' }}
            {{ $row->options?->color ? 'Color: '.$row->options?->color :'' }}
        </a>
    </td>
    <td class="pro-price"><span>${{ number_format($row->price, 2) }}</span></td>
    <td class="pro-quantity">
        <div class="pro-qty"><input type="text" id="update_qty" name="update_qty[]" value="{{ $row->qty }}"></div>
        <input type="hidden" id="update_rowid" name="update_rowid[]" value="{{ $row->rowId }}">
    </td>
    <td class="pro-subtotal"><span>${{ number_format($row->price * $row->qty, 2) }}</span></td>
    <td class="pro-remove"><a href="javascript:;" onclick="deleteCartItem('{{ $row->rowId }}', '{{ route('frontend.cart.remove') }}','cart_big')"><i class="fa fa-trash-o"></i></a></td>
</tr>
@endforeach
