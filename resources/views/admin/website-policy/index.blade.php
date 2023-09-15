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
                    <h4 class="">WEBSITE POLICIES</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.website-policy') }}">Website Policies</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p class="comon-heading">Enter Your All Policies Informations Here</p>
            </div>
        </div>
        <form action="{{ route('admin.website-policy') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <label>Privacy Policy</label>
                    <div class="form-group">
                        <textarea id="privacy_policy" name="privacy_policy">{!! @$data->privacy_policy !!}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label>Terms & Conditions</label>
                    <div class="form-group">
                        <textarea id="terms_conditions" name="terms_conditions">{!! @$data->terms_conditions !!}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label>Cookies Policy</label>
                    <div class="form-group">
                        <textarea id="cookies_policy" name="cookies_policy">{!! @$data->cookies_policy !!}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label>Return Policy</label>
                    <div class="form-group">
                        <textarea id="return_policy" name="return_policy">{!! @$data->return_policy !!}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label>Disclaimer</label>
                    <div class="form-group">
                        <textarea id="disclaimer" name="disclaimer">{!! @$data->disclaimer !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button class="btn btn-primary submit-button" type="submit">
                        Save Change
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
    $('#privacy_policy').summernote({height: 150});
    $('#terms_conditions').summernote({height: 150});
    $('#cookies_policy').summernote({height: 150});
    $('#return_policy').summernote({height: 150});
    $('#disclaimer').summernote({height: 150});
</script>
@endsection
