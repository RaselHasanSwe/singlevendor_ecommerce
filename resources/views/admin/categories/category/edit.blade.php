@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">CATEGORY UPDATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.category.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.category.index') }}">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="categoryForm" action="{{ route('admin.category.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                            <img src="{{ $data->image ? ImageViewer::show($data->image) : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="image" id="wizard-picture" class="wizard-picture" accept="image/*">
                        </div>
                        <h6 class="thm-img">Upload Image</h6>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input name="name" class="form-control" value="{{ $data->name }}" type="text" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Show Category in Main Menu</label><br/>
                                <input type="checkbox" {{ $menu ? 'checked' : '' }} name="show_main_menu" data-toggle="toggle" data-onstyle="danger" data-offstyle="warning">
                            </div>
                        </div>
                        <div class="col-sm-12 m-t-20">
                            <button type="submit" class="btn btn-success submit-button float-right">Save Category</button>
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
    $(document).on('submit', '#categoryForm', function(){
        setLoader();
    })
</script>
@endsection
