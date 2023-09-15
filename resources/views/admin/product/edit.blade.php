@extends('admin.layout.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">PRODUCT UPDATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.product.index') }}">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="productForm" action="{{ route('admin.product.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                @include('admin.product.__pertials.basic-info')
                @include('admin.product.__pertials.color-size')
                @include('admin.product.__pertials.photo-section')
                @include('admin.product.__pertials.aditional-info')
                @include('admin.product.__pertials.shipping')
                @include('admin.product.__pertials.variations')
            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button class="btn btn-primary submit-button" type="submit">
                        Save Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    //plugin intial
    $('#sort_description').summernote({height: 150});
    $('#full_specfications').summernote({height: 150});
    $('#full_description').summernote({height: 150});


    //Aditional images
    function appendAditionalImage()
    {
        let html = `
            <div class="col-sm-4 mb-5">
                <div class="picture-container">
                    <div class="picture" id="fixed-height">
                        <img src="{{ asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                        <input type="file" name="extra_image[]" id="wizard-picture" class="wizard-picture" accept="image/*">
                        <input type="hidden" name="extra_image_id[]" value="">
                    </div>
                </div>
                <span class="remove-aditional-image">Remove</span>
            </div>
        `;
        $('#appendAditionalImage').append(html)
    }
    $(document).on('click', '.remove-aditional-image', function() {
        deleteImage($(this).attr('id'));
        $(this).parent().remove();
    });


    //Product variations
    function generateVariatioon()
    {

        let color_size = JSON.parse('<?= addslashes(json_encode($color_size)) ?>');
        let color_size_price = JSON.parse('<?= addslashes(json_encode($color_size_price)) ?>');
        let color_size_image = JSON.parse('<?= addslashes(json_encode($color_size_image)) ?>');

        let colors = [];
        let colorsId = [];

        let sizes = [];
        let sizesId = [];

        $("#colors option:selected").each(function () {
            let $this = $(this);
            if ($this.length) {
                colors.push($this.text());
                colorsId.push($this.val());
            }
        });

        $("#sizes option:selected").each(function () {
            let $this = $(this);
            if ($this.length) {
                sizes.push($this.text());
                sizesId.push($this.val());
            }
        });

        let totalColor = colors.length;
        let totalSize = sizes.length;
        if(totalColor < 1 || totalSize < 1) {
            //toastr.info('Please Select Color and Size', 'Info!')
            return false;
        }

        let appendAbleHtml = '';
        for(let i = 0; i < totalColor; i++){
            for(let j = 0; j < totalSize; j++){
                let itemPrice = 0;
                let itemImage = '';
                let mkVariation = `${colorsId[i]}-${sizesId[j]}`;
                let getIndex = color_size.indexOf(mkVariation)
                if(getIndex !== -1){
                    itemPrice = color_size_price[getIndex];
                    itemImage = color_size_image[getIndex];
                }

                appendAbleHtml += variationHtml(colors[i], sizes[j], colorsId[i], sizesId[j], itemPrice, itemImage);
            }
        }
        console.log("vaiation working");
        $('.set-veriations').html(appendAbleHtml);
    }

    function variationHtml(color, size, colorId, sizeId, itemPrice, itemImage)
    {
        let extraImage = itemImage ? itemImage : "{{ asset('admin_assets/assets/img/upload-icon.jpg') }}";

        let htmlItem = `
            <div class="row variation-div">
                <div class="col-sm-1">
                    <div class="picture-container">
                        <div class="picture">
                            <img src="${extraImage}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="variation_image[]" id="wizard-picture" class="wizard-picture" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h5 class="variationPd">${color}</h5>
                    <input type="hidden" name="variation_color[]" value="${colorId}">
                </div>
                <div class="col-sm-3">
                    <h5 class="variationPd">${size}</h5>
                    <input type="hidden" name="variation_size[]" value="${sizeId}">
                </div>
                <div class="col-sm-3">
                    <div class="form-group variationPd">
                        <input name="variation_price[]" class="form-control" placeholder="Eneter Price" value="${itemPrice}" type="number">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group variationPd">
                        <button type="button" class="btn btn-danger remove-variation">Remove</button>
                    </div>
                </div>
            </div>
        `;
        return htmlItem;
    }

    $(document).on('click', '.remove-variation', function() {
        $(this).closest('.variation-div').remove();
    });

    function showVariatiion(){
        $('.set-veriations').removeClass('d-none');
    }


    // get sub category

    $(document).on('change', '#category', function(){
        let id = $(this).val();
        let url = "{{ route('admin.sub-category.show', ":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: url,
            success: function(response) {
                $('#sub_category').html(response);
            }
        });
    })

    // get inner category
    $(document).on('change', '#sub_category', function(){
        let id = $(this).val();
        let url = "{{ route('admin.inner-category.show', ":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: url,
            success: function(response) {
                $('#inner_category').html(response);
            }
        });
    })

    $(document).on('submit', '#productForm', function(){
        if ($("input[name='name']").val() == '') {
            toastr.error("Please Enter Product Name");
            return false;
        }
        if ($("input[name='sku']").val() == '') {
            toastr.error("Please Enter Product SKU");
            return false;
        }
        if ($("input[name='stock']").val() == '') {
            toastr.error("Please Enter Product Stock");
            return false;
        }
        if ($("input[name='price']").val() == '') {
            toastr.error("Please Enter Product Price");
            return false;
        }
        if ($("#category").val() == '') {
            toastr.error("Please Enter Product Category");
            return false;
        }

        let shipping_price = $("input[name='shipping_price[]']")
              .map(function(){return $(this).val();}).get();
        let shipping_apply = $("select[name='shipping_apply[]']")
              .map(function(){return $(this).val();}).get();
        var shipping_is_free = $(".shipping_is_free input:checkbox:checked").map(function(){
            return $(this).val();
        }).get();

        shipping_price = shipping_price.filter(function (el) {
            return el != '';
        });

        shipping_is_free = shipping_is_free.filter(function (el) {
            return el != '';
        });

        if(shipping_price.length < 1 && shipping_is_free.length < 1 ){
            toastr.error("Please Select Atleast One Shipping");
            return false;
        }


        setLoader();
    })

    // Image remove function
    function deleteImage(id)
    {
        if(id == '') return false;
        var data = new FormData();
        data.append('_token', '{{ csrf_token() }}')
        data.append('id', id)

        $.ajax({
            processData: false,
            contentType: false,
            data: data,
            type: 'POST',
            url: "{{ route('admin.product.image.delete') }}",
            success: function(response) {
                toastr.success(response, "Success");
            }
        });
    }


</script>
@endsection
