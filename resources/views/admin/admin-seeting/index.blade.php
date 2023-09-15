@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">ADMIN SETTING</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.admin-setting') }}">Admin Setting</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p class="comon-heading">Change Password</p>
            </div>
        </div>
        <form action="{{ route('admin.admin-setting') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>New Password</label>
                        <input name="new_password" class="form-control" value="" type="password" required>
                        @if($errors->has('new_password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('new_password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input name="confirm_new_password" class="form-control" value="" type="password" required>
                        @if($errors->has('confirm_new_password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('confirm_new_password') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button class="btn btn-primary submit-button" type="submit">
                        Change Password
                    </button>
                </div>
            </div>
        </form>

        <div class="row mt-4">
            <div class="col-sm-12">
                <p class="comon-heading">Change Email</p>
            </div>
        </div>
        <form action="{{ route('admin.admin-setting') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input name="email" class="form-control" value="" type="email" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input name="current_password" class="form-control" value="" type="password" required>
                        @if($errors->has('current_password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('current_password') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button class="btn btn-primary submit-button" type="submit">
                        Change Email
                    </button>
                </div>
            </div>
        </form>

        <div class="row mt-4">
            <div class="col-sm-12">
                <p class="comon-heading">Change Name & Profile Image</p>
            </div>
        </div>
        <form action="{{ route('admin.admin-setting') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-2">
                    <div class="picture-container">
                        <div class="picture">
                            <img src="{{ asset('admin_assets/assets/img/upload-icon.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                            <input type="file" name="main_image" id="wizard-picture" class="wizard-picture" accept="image/*">
                        </div>
                        <h6 class="thm-img">Upload Profile Image</h6>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Admin Name</label>
                                <input name="admin_name" class="form-control" value="" type="text" required>
                                @if($errors->has('admin_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('admin_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
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

@endsection
