@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">SIZE UPDATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.size.index') }}">Size</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.size.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="sizeForm" action="{{ route('admin.size.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Size Name</label>
                        <input name="name" class="form-control" value="{{ $data->name }}" type="text">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Size Measurement</label>
                        <input name="measurement" class="form-control" value="{{ $data->measurement }}" type="text" required>
                        @if($errors->has('measurement'))
                            <div class="invalid-feedback">
                                {{ $errors->first('measurement') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button type="submit" class="btn btn-success submit-button float-right">Save Size</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on('submit', '#sizeForm', function(){
        setLoader();
    })
</script>
@endsection
