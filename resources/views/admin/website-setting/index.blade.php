@extends('admin.layout.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style>
    .banner-src{
        max-height: 300px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">WEBSITE SETTING</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.website-setting') }}">Website Setting</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p class="comon-heading">Basic Informations</p>
            </div>
        </div>
        <form action="{{ route('admin.website-setting') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Website Name</label>
                        <input name="website_name" class="form-control" value="{{ $data->website_name }}" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Website Email</label>
                        <input name="website_email" class="form-control" value="{{ $data->website_email }}" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Website Phone</label>
                        <input name="website_phone" class="form-control" value="{{ $data->website_phone }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Website Address</label>
                        <textarea name="website_address" class="form-control">{{ $data->website_address }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Website Contact Us</label>
                        <textarea name="website_contact_us" class="form-control">{{ $data->website_contact_us }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Website Working Hours</label>
                        <textarea name="website_working_hours" class="form-control">{{ $data->website_working_hours }}</textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <p class="comon-heading">Website Invoice Aditional</p>
                </div>

                <div class="col-sm-12">
                    <label>Invoice Aditional</label>
                    <div class="form-group">
                        <textarea id="invoice_aditional" name="invoice_aditional">{!! @$data->invoice_aditional !!}</textarea>
                    </div>
                </div>


                <div class="col-sm-12">
                    <p class="comon-heading">Website Logo and Favicon</p>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Website Logo</label>
                        <input type="file" name="logo" class="form-control" id="logo">
                        <img class="img-thumbnail logo-src mt-4" src="{{ $data->website_logo ? ImageViewer::show($data->website_logo) : '' }}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Website Favicon</label>
                        <input type="file" name="favicon" class="form-control" id="favicon">
                        <img class="img-thumbnail favicon-src mt-4 text-center" src="{{ $data->website_favicon ? ImageViewer::show($data->website_favicon) : '' }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <p class="comon-heading">Website About Us Content</p>
                </div>

                <div class="col-sm-12">
                    <label>About Us</label>
                    <div class="form-group">
                        <textarea id="website_about_us" name="website_about_us">{!! @$data->website_about_us !!}</textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Happy Customer Background Banner</label>
                        <input type="file" name="banner" class="form-control" id="banner">
                        <img class="img-thumbnail banner-src mt-4" src="{{ $data->happy_customer_background_image ? ImageViewer::show($data->happy_customer_background_image) : '' }}">
                    </div>
                </div>



                <div class="col-sm-12">
                    <p class="comon-heading">Social Link</p>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Facebook Link</label>
                        <input name="fb" class="form-control" value="{{ $data->fb }}" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Twitter Link</label>
                        <input name="tw" class="form-control" value="{{ $data->tw }}" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Instagram Link</label>
                        <input name="ins" class="form-control" value="{{ $data->ins }}" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Google Plus Link</label>
                        <input name="gp" class="form-control" value="{{ $data->gp }}" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Youtube Link</label>
                        <input name="yt" class="form-control" value="{{ $data->yt }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <p class="comon-heading">Header Display Text</p>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 1 Title</label>
                        <input name="section_1_title" class="form-control" value="{{ $data->section_1_title }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 1 Sort Title</label>
                        <input name="section_1_sort_title" class="form-control" value="{{ $data->section_1_sort_title }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 1 Icon</label>
                        <input name="section_1_icon" class="form-control" value="{{ $data->section_1_icon }}" type="text">
                    </div>
                </div>
                <hr/>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 2 Title</label>
                        <input name="section_2_title" class="form-control" value="{{ $data->section_2_title }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 2 Sort Title</label>
                        <input name="section_2_sort_title" class="form-control" value="{{ $data->section_2_sort_title }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 2 Icon</label>
                        <input name="section_2_icon" class="form-control" value="{{ $data->section_2_icon }}" type="text">
                    </div>
                </div>
                <hr/>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 3 Title</label>
                        <input name="section_3_title" class="form-control" value="{{ $data->section_3_title }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 3 Sort Title</label>
                        <input name="section_3_sort_title" class="form-control" value="{{ $data->section_3_sort_title }}" type="text">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Section 3 Icon</label>
                        <input name="section_3_icon" class="form-control" value="{{ $data->section_3_icon }}" type="text">
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
    $('#invoice_aditional').summernote({height: 150});
    $('#website_about_us').summernote({height: 150});
    $(document).ready(function(){
        $(document).on('change', '#logo', function(){
            readImageURL(this, 'logo-src');
        });
        $(document).on('change', '#banner', function(){
            readImageURL(this, 'banner-src');
        })
    });
    $(document).ready(function(){
        $(document).on('change', '#favicon', function(){
            readImageURL(this, 'favicon-src');
        })
    });
    function readImageURL(input, src) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.'+src).attr('src', e.target.result).fadeIn('slow')
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
