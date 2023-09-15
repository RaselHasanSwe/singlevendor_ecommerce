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
                    <h4 class="">FAQ CREATE</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.faq.index') }}">FAQ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('admin.faq.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr/>
        <form id="faqForm" action="{{ route('admin.faq.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Question</label>
                        <input name="question" class="form-control" value="" type="text" required>
                        @if($errors->has('question'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Answer</label>
                        <textarea id="answer" name="answer" required></textarea>
                        @if($errors->has('answer'))
                            <div class="invalid-feedback">
                                {{ $errors->first('answer') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 m-t-20">
                    <button type="submit" class="btn btn-success submit-button float-right">Save FAQ</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $('#answer').summernote({height: 150});
    $(document).on('submit', '#faqForm', function(){
        setLoader();
    })
</script>
@endsection
