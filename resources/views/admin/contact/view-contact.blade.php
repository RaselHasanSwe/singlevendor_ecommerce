@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-sm-7 col-6">
        <h4 class="page-title">{{ $data->name }}</h4>
    </div>

    <div class="col-sm-5 col-6 text-right m-b-30">
        <a href="{{ route('admin.contact') }}" class="btn btn-primary btn-rounded">Back to Contact</a>
    </div>
</div>
<div class="card-box profile-header">
    <div class="row">
        <div class="col-md-12">
            <div class="profile-view">
                <div class="profile-img-wrap">
                    <div class="profile-img">
                        <a href="#"><img class="avatar" src="{{ asset('admin_assets/assets/img/user.jpg') }}" alt=""></a>
                    </div>
                </div>
                <div class="profile-basic">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="profile-info-left">
                                <h3 class="user-name m-t-0 mb-0">{{ $data->name }}</h3>
                                <small class="text-muted">{{ date('Y-m-d H:i A', strtotime($data->created_at)) }}</small>
                                <div class="staff-id">Email : {{ $data->email }}</div>
                                <div class="staff-id">Phone : {{ $data->phone }}</div>
                                <div class="staff-msg"><a href="" class="btn btn-primary">Delete Message</a></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class="personal-info">
                                <li>
                                    {{ $data->message }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
