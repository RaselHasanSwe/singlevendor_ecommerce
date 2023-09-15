@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="row">
            <div class="col-sm-4 col-3">
                <nav aria-label="breadcrumb">
                    <h4 class="">COUPON CREATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.coupon.index') }}">Coupon</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="couponForm" action="{{ route('admin.coupon.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Coupon Name</label>
                        <input name="coupon_name" class="form-control" value="" type="text" required>
                        @if($errors->has('coupon_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupon_name') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Coupon Code</label>
                        <input name="coupon_code" class="form-control" value="" type="text" required>
                        @if($errors->has('coupon_code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupon_code') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Minimun Amount To Buy</label>
                        <input name="minimum_amount_to_buy" class="form-control" value="" type="text" required>
                        @if($errors->has('minimum_amount_to_buy'))
                            <div class="invalid-feedback">
                                {{ $errors->first('minimum_amount_to_buy') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Coupon Amount</label>
                        <input name="amount" class="form-control" value="" type="number" required>
                        @if($errors->has('amount'))
                            <div class="invalid-feedback">
                                {{ $errors->first('amount') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Coupon Start Time</label>
                        <input class="form-control"
                            type="datetime-local"
                            id="coupon_start_time"
                            name="coupon_start_time"
                            required
                        />
                        @if($errors->has('coupon_start_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupon_start_time') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Coupon End Time</label>
                        <input class="form-control"
                            type="datetime-local"
                            id="coupon_end_time"
                            name="coupon_end_time"
                            required
                        />
                        @if($errors->has('coupon_end_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupon_end_time') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Coupon Description</label>
                        <textarea class="form-control" name="coupon_description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button type="submit" class="btn btn-success submit-button float-right">Save Coupon</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on('submit', '#couponForm', function(){
        setLoader();
    })
</script>
@endsection
