@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-5 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">INNER CATEGORY UPDATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.inner-category.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.inner-category.index') }}">Inner Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-7 col-9 text-right m-b-20">
                <a href="{{ route('admin.inner-category.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="categoryForm" action="{{ route('admin.inner-category.update', $data->id) }}" method="post" enctype="multipart/form-data">
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
                            <img src="{{ $data->image ? ImageViewer::show($data->image, 'sm-') : asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="image" id="wizard-picture" class="wizard-picture" accept="image/*">
                        </div>
                        <h6 class="thm-img">Upload Image</h6>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Inner Category Name</label>
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
                                <label>Select Category</label>
                                <select class="form-control select" name="category" required id="category">
                                    <option value="">--select category--</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" {{ $data->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('category') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select Sub Category</label>
                                <select class="form-control select" id="sub_category" name="sub_category" required>
                                    <option value="">--select sub category--</option>
                                    @foreach ($sub_category as $item)
                                        <option value="{{ $item->id }}" {{ $data->sub_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('sub_category'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('sub_category') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Show Inner Category in Main Menu</label><br/>
                                <input type="checkbox" {{ $menu ? 'checked' : '' }} name="show_main_menu" data-toggle="toggle" data-onstyle="danger" data-offstyle="warning">
                            </div>
                        </div>
                        <div class="col-sm-12 m-t-20">
                            <button type="submit" class="btn btn-success submit-button float-right">Save Inner Category</button>
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
    </script>
    <script>
        $(document).on('submit', '#categoryForm', function(){
            setLoader();
        })
    </script>
@endsection
