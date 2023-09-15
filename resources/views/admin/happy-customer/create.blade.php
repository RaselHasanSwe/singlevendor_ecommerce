@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">TEAM CREATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.happy-customer.index') }}">Happy Customer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.happy-customer.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="happyCustomerForm" action="{{ route('admin.happy-customer.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @if($errors->has('avatar'))
                    <div class="col-sm-12">
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('avatar') }}
                        </div>
                    </div>
                @endif

                <div class="col-sm-3">
                    <div class="picture-container">
                        <div class="picture">
                            <img src="{{ asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="avatar" id="wizard-picture" class="wizard-picture" accept="image/*" required>
                        </div>
                        <h6 class="thm-img">Upload Avatar</h6>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" class="form-control" value="{{ old('name') }}" type="text" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>What Said</label>
                                <textarea name="what_said" class="form-control" required>{{ old('what_said') }}</textarea>
                                @if($errors->has('what_said'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('what_said') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 m-t-20">
                            <button type="submit" class="btn btn-success submit-button float-right">Save Happy Customer</button>
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
    $(document).on('submit', '#happyCustomerForm', function(){
        setLoader();
    })
</script>
@endsection
