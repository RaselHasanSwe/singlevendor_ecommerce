<div class="col-sm-12 mt-5">
    <div class="row">
        <div class="col-sm-8">
            <h4>Make Your Product Variations</h4>
        </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-success" style="float: right" onclick="showVariatiion()">Show Variation</button>
        </div>
    </div>
    <hr/>
</div>
<div class="col-sm-12 set-veriations">
    @if(@$data?->variations && count(@$data->variations) > 0)
        @foreach ($data?->variations as $variation)
            <div class="row variation-div">
                <div class="col-sm-1">
                    <div class="picture-container">
                        <div class="picture">
                            <img src="{{ $variation->image ? ImageViewer::show($variation->image) : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="variation_image[]" id="wizard-picture" class="wizard-picture" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h5 class="variationPd">{{ $variation->color?->name }}</h5>
                    <input type="hidden" name="variation_color[]" value="{{ $variation->color?->id }}">
                </div>
                <div class="col-sm-3">
                    <h5 class="variationPd">{{ $variation->size?->name }}</h5>
                    <input type="hidden" name="variation_size[]" value="{{ $variation->size?->id }}">
                </div>
                <div class="col-sm-3">
                    <div class="form-group variationPd">
                        <input name="variation_price[]" class="form-control" placeholder="Eneter Price" value="{{ $variation->price }}" type="number">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group variationPd">
                        <button type="button" class="btn btn-danger remove-variation">Remove</button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
