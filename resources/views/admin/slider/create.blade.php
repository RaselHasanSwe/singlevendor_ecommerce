@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">SLIDER CREATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.slider.index') }}">Slider</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.slider.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="sliderForm" action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @if($errors->has('image'))
                    <div class="col-sm-12">
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('image') }}
                        </div>
                    </div>
                @endif
                <div class="col-sm-3">
                    <div class="picture-container">
                        <div class="picture">
                            <img src="{{ asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="image" id="wizard-picture" class="wizard-picture" accept="image/*" required>
                        </div>
                        <h6 class="thm-img">Upload Image</h6>
                    </div>
                </div>

                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input name="title" class="form-control" value="{{ old('title') }}" type="text">
                                @if($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Button Name</label>
                                <input name="button_name" class="form-control" value="{{ old('button_name') }}" type="text">
                                @if($errors->has('button_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('button_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Button Url</label>
                                <input name="button_url" class="form-control" value="{{ old('button_url') }}" type="text">
                                @if($errors->has('button_url'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('button_url') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-12 m-t-20">
                            <button type="submit" class="btn btn-success submit-button float-right">Save Slider</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on('submit', '#sliderForm', function(){
        setLoader();
    })
</script>
@endsection
