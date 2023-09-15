function addToCart(url, product_id, qty, color = '', size = '')
{
    let data = new FormData();
    data.append('product_id', product_id);
    data.append('qty', qty);
    data.append('color', color);
    data.append('size', size);
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            console.log(response);
            $('.set-cart-list').html(response.mini_cart);
            $('.set-total-item').html(response.total_item);
            toastr.success('Item Successfully Added To Cart', 'Success!');

        }
    });
}

function deleteCartItem(rowId, url, cart_big = '')
{
    let data = new FormData();
    data.append('rowId', rowId);
    data.append('cart_big', cart_big);
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            console.log(response);
            $('.set-grand-total').html('$'+response.total_price)
            $('.set-total-item').html(response.total_item);
            $('#'+rowId).remove();
            $('#big-'+rowId).remove();
            $('.big-cart-total').html(response.big_cart_total);
        }
    });
}

function updateCartItem( url )
{
    let data = new FormData();
    var update_qty = $("input[name='update_qty[]']").map(function(){return $(this).val();}).get();
    var update_rowid = $("input[name='update_rowid[]']").map(function(){return $(this).val();}).get();

    data.append('update_qty', update_qty);
    data.append('update_rowid', update_rowid);
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            console.log(response);
            $('.set-cart-list').html(response.mini_cart);
            $('.set-total-item').html(response.total_item);
            $('.set-big-cart-item').html(response.big_cart);
            $('.big-cart-total').html(response.big_cart_total);
            assingQtyPlugin();
        }
    });
}

function assingQtyPlugin()
{
    let proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
}

function makeFilter()
{
    $('#filter_form').submit();
}

$(document).on('submit', '#filter_form', function(e){
    e.preventDefault()
    let url = window.location.href.split("?")[0];
    let data = new FormData( $( 'form#filter_form' )[ 0 ] );
    data.append('_token', $('meta[name="_token"]').attr('content'));
    data.append('sort_by', $('#sort_by').val());
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            console.log(response);
            $('.set-all-products').html(response.products);
        }
    });
})

$(document).on('click', '.click_color',function(){
    $('.click_color').removeClass('activec');
    $(this).addClass('activec');
    $('#active_color').val($(this).attr('id'));
})

$(document).on('click', '#add_to_cart_from_product_details', function(){
    let color = '';
    if($('.has_color').hasClass('get_active_color')){
        color = $('#active_color').val();
        if(!color){
            toastr.error('Please Select Color', 'Error!')
            return false;
        }
    }
    let size = '';
    if($('.has_size').hasClass('get_active_size')){
        size = $('#active_size').val();
        if(!size){
            toastr.error('Please Select Size', 'Error!')
            return false;
        }
    }
    let qty = $('#qty').val();
    if(qty < 1){
        toastr.error('Please Enter Quentity', 'Error!')
        return false;
    }
    let url = $('#cart_url').val();
    let product_id = $('#product_id').val();

    addToCart(url, product_id, qty, color, size)

})

$(document).on('click', '.click_color_image', function(){
    let color = $('#active_color').val();
    let size = $('#active_size').val();
    if(color == '' || size == '') return false;
    getVariationPrice(color, size)
})

$(document).on('change','#active_size', function(){
    let color = $('#active_color').val();
    let size = $('#active_size').val();
    if(color == '' || size == '') return false;
    getVariationPrice(color, size)
})

function getVariationPrice(color, size)
{
    let url = $('#variation_url').val();
    let product_id = $('#product_id').val();
    let data = new FormData();
    data.append('_token', $('meta[name="_token"]').attr('content'));
    data.append('color', color);
    data.append('size', size);
    data.append('product_id', product_id);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            console.log(response);
            if(response.price) $('#set_variation_price').html('$'+response.price);
        }
    });
}

$(document).on('submit','#couponForm', function(e){
    e.preventDefault();
    let url = $(this).attr('action');
    let data = new FormData( $( 'form#couponForm' )[ 0 ] );
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            console.log(response);
            if(response.status == true){
                toastr.success(response.message, 'Success!')
                $('.big-cart-total').html(response.big_cart_total);
            }else{
                toastr.error(response.message, 'Error!')
            }
        }
    });
})


$(document).on('change', '#country_from', function(){
    let shipping_id = $(this).val();
    let url = $('#shipping_url').val();
    let data = new FormData();
    data.append('shipping_id', shipping_id);
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            if(response.status == false)
                $('.shipping-error-msg').html(response.message);
            if(response.status == true)
                $('.set-order-summary').html(response.order_summary);
        }
    });
})

function wishlist( product_id )
{

    let url = $('#wishlist_add_url').val();
    let data = new FormData();
    data.append('product_id', product_id);
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            if(response.success == false)
                toastr.error(response.message, 'Error!')
            if(response.success == true)
                toastr.success(response.message, 'Success!')
        }
    });
}

function wishlistRemove( id )
{
    let url = $('#wishlist_remove_url').val();
    let data = new FormData();
    data.append('id', id);
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            if(response.success == false){
                toastr.error(response.message, 'Error!')
            }

            if(response.success == true){
                $('#wishlist-'+id).remove();
                toastr.success(response.message, 'Success!')
            }

        }
    });
}

$(document).on('submit', '#mc-form-submit', function(event){
    event.preventDefault();
    let url = $('#subscribe_url').val();
    let data = new FormData();
    let email = $('#mc-email').val();
    if(email == '') return false;
    data.append('email', email);
    data.append('_token', $('meta[name="_token"]').attr('content'));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: url,
        data:data,
        success: function(response) {
            if(response.success == false){
                toastr.error(response.message, 'Error!')
            }
            if(response.success == true){
                toastr.success(response.message, 'Success!')
                $('#mc-email').val('')
            }

        }
    });
})
