@extends('frontend.layout.app')

@section('title') Home @endsection
@section('style') @endsection

@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
 <!-- login register wrapper start -->
 <div class="login-register-wrapper mb-5">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                @forelse ($item as $key => $faq)
                    <div class="col-lg-12 mb-3">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="heading{{ $faq->id }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse{{ $faq->id }}" class="collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion">
                                    <div class="card-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            NO FAQ FOUND
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- login register wrapper end -->
@endsection


@section('script') @endsection

