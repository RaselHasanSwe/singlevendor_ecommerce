@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">TEAM UPDATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.team.index') }}">Team</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.team.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="teamForm" action="{{ route('admin.team.update', @$data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                            <img src="{{ ImageViewer::show($data->image) }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="avatar" id="wizard-picture" class="wizard-picture" accept="image/*">
                        </div>
                        <h6 class="thm-img">Upload Avatar</h6>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" class="form-control" value="{{ old('name') ? old('name') : @$data->name  }}" type="text" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Designation</label>
                                <input name="designation" class="form-control" value="{{ old('designation') ? old('designation') : @$data->designation }}" type="text" required>
                                @if($errors->has('designation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('designation') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Sort Description</label>
                                <textarea name="sort_description" class="form-control" required>{{ old('sort_description') ? old('sort_description') : @$data->sort_description }}</textarea>
                                @if($errors->has('sort_description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('sort_description') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Facebook Url</label>
                                <input name="fb" class="form-control" value="{{ old('fb') ? old('fb') : @$data->fb }}" type="text" >
                                @if($errors->has('fb'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fb') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Twiter Url</label>
                                <input name="tw" class="form-control" value="{{ old('tw') ? old('tw') : @$data->tw }}" type="text" >
                                @if($errors->has('tw'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tw') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Linkedin Url</label>
                                <input name="ln" class="form-control" value="{{ old('ln') ? old('ln') : @$data->ln }}" type="text" >
                                @if($errors->has('ln'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('ln') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Google Plus Url</label>
                                <input name="gp" class="form-control" value="{{ old('gp') ? old('gp') : @$data->gp }}" type="text" >
                                @if($errors->has('gp'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('gp') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 m-t-20">
                            <button type="submit" class="btn btn-success submit-button float-right">Update Team</button>
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
    $(document).on('submit', '#teamForms', function(){
        setLoader();
    })
</script>
@endsection
