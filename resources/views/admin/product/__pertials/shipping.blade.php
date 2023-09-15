<div class="col-sm-12 mt-5">
     <h4>Product Shipping</h4>
     <hr/>
</div>

@foreach ($shipping as $key => $item)
    @php
        $existItem = Str::ShippingMargeAdmin($item->id, @$data->shipping);
    @endphp
    <div class="col-sm-3">
        <div class="form-group">
            <label>Ship To</label>
            <input name="" class="form-control" value="{{ Str::ShipTo($item->ship_to, $admin->city) }}" type="text" disabled>
            <input type="hidden" name="shipping_id[]" value="{{ $item->id }}">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Shipping Price</label>
            <input name="shipping_price[]" class="form-control" value="{{ array_key_exists('price', $existItem) ? $existItem['price'] : ''  }}" type="number">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Apply Shipping</label>
            <select class="form-control select" name="shipping_apply[]">
                <option value="2" {{ array_key_exists('shipping_apply', $existItem) && $existItem['shipping_apply'] == 2 ? 'selected' : ''  }}>All Quantity</option>
                <option value="1" {{ array_key_exists('shipping_apply', $existItem) && $existItem['shipping_apply'] == 1 ? 'selected' : ''  }}>Per Quantity</option>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="custom-control custom-checkbox shipping_is_free"  style="margin-top: 35px">
            <input type="checkbox" name="shipping_is_free-{{ $item->id }}" class="custom-control-input" id="customControlInline{{ $item->id }}" value="1" {{ array_key_exists('is_free', $existItem) && $existItem['is_free'] == 1 ? 'checked' : ''  }}>
            <label class="custom-control-label" for="customControlInline{{ $item->id }}">Free Shipping</label>
        </div>
    </div>
@endforeach


