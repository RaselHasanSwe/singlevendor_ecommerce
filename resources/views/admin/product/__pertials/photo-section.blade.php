<div class="col-sm-12">
    <h4>Upload Your Photo</h4>
    <hr/>
</div>

<div class="col-sm-4">
    <div class="picture-container">
        <div class="picture">
            <img src="{{ @$data->thumbnail ? ImageViewer::show(@$data->thumbnail, 'md-') : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
            <input type="file" name="main_image" id="wizard-picture" class="wizard-picture" accept="image/*">
        </div>
        <h6 class="thm-img">Upload Thumbnail Image</h6>
    </div>
</div>

<div class="col-sm-8">
    <div class="row" id="appendAditionalImage">
        <div class="col-sm-4 mb-5">
            <div class="picture-container">
                <div class="picture" id="fixed-height">
                    <img src="{{ @$data->images && count(@$data->images) > 0 ? ImageViewer::show(@$data->images[0]->image, 'sm-') : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                    <input type="file" name="extra_image[]" id="wizard-picture" class="wizard-picture" accept="image/*">
                    <input type="hidden" name="extra_image_id[]" value="{{ @$data->images && count(@$data->images) > 0 ? @$data->images[0]->id : ''}}">
                </div>
            </div>
            <span class="remove-aditional-image" id="{{ @$data->images && count(@$data->images) > 0 ? @$data->images[0]->id : '' }}">Remove</span>
        </div>
        <div class="col-sm-4 mb-5">
            <div class="picture-container">
                <div class="picture" id="fixed-height">
                    <img src="{{ @$data->images && count(@$data->images) > 1 ? ImageViewer::show(@$data->images[1]->image, 'sm-') : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                    <input type="file" name="extra_image[]" id="wizard-picture" class="wizard-picture" accept="image/*">
                    <input type="hidden" name="extra_image_id[]" value="{{ @$data->images && count(@$data->images) > 1 ? @$data->images[1]->id : ''}}">
                </div>
            </div>
            <span class="remove-aditional-image" id="{{ @$data->images && count(@$data->images) > 1 ? @$data->images[1]->id : '' }}">Remove</span>
        </div>
        <div class="col-sm-4 mb-5">
            <div class="picture-container">
                <div class="picture" id="fixed-height">
                    <img src="{{ @$data->images && count(@$data->images) > 2 ? ImageViewer::show(@$data->images[2]->image, 'sm-') : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                    <input type="file" name="extra_image[]" id="wizard-picture" class="wizard-picture" accept="image/*">
                    <input type="hidden" name="extra_image_id[]" value="{{ @$data->images && count(@$data->images) > 2 ? @$data->images[2]->id : ''}}">
                </div>
            </div>
            <span class="remove-aditional-image" id="{{ @$data->images && count(@$data->images) > 2 ? @$data->images[2]->id : '' }}">Remove</span>
        </div>
        @if(@$data->images && count(@$data->images) > 3)
            @foreach (@$data->images as $key => $image)
                @php if($key < 3) continue; @endphp
                <div class="col-sm-4 mb-5">
                    <div class="picture-container">
                        <div class="picture" id="fixed-height">
                            <img src="{{ $image->image ? ImageViewer::show($image->image, 'sm-') : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="extra_image[]" id="wizard-picture" class="wizard-picture" accept="image/*">
                            <input type="hidden" name="extra_image_id[]" value="{{ $image->image ? $image->id : ''}}">
                        </div>
                    </div>
                    <span class="remove-aditional-image" id="{{ $image->image ? $image->id : '' }}">Remove</span>
                </div>
            @endforeach
        @endif

    </div>
    <button type="button" class="btn btn-info add-more-btn" onclick="appendAditionalImage()">Add More</button>
</div>
