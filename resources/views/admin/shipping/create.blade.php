@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">SHIPPING CREATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.shipping.index') }}">Shipping</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.shipping.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="shippingForm" action="{{ route('admin.shipping.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Shipping Name</label>
                        <input name="name" class="form-control" value="" type="text" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Duration Time</label>
                        <input name="duration" class="form-control" value="" type="text" required>
                        @if($errors->has('duration'))
                            <div class="invalid-feedback">
                                {{ $errors->first('duration') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ship To</label>
                        <select class="form-control select" name="ship_to" required>
                            <option value="">select ship to</option>
                            <option value="1">{{ Str::ShipTo(1, $admin->city) }}</option>
                            <option value="2">{{ Str::ShipTo(2, $admin->city) }}</option>
                        </select>
                        @if($errors->has('ship_to'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ship_to') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button type="submit" class="btn btn-success submit-button float-right">Save Shipping</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on('submit', '#shippingForm', function(){
        setLoader();
    })
</script>
@endsection
