@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <nav aria-label="breadcrumb">
            <h4 class="">FAQ LIST</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.faq.index') }}">FAQ</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('admin.faq.create') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Create FAQ</a>
    </div>
</div>
<form method="get">
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">Search</label>
                <input type="text" name="key" class="form-control floating" value="{{ request()->key }}">
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <button type="submit" class="btn btn-info btn-block"> Search </button>
        </div>
        <div class="col-sm-6 col-md-2">
            <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary btn-block"> Reset </a>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr>
                            <td>{{ $index + $data->firstItem() }}</td>
                            <td>{{ Str::limit($item->question, 100) }}</td>
                            <td>{!! Str::limit($item->answer, 100) !!}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('admin.faq.edit', $item->id) }}"><i class="fa fa-edit m-r-5"></i>Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_appointment" onclick="deleteAlert({{ 'deleteForm'.$item->id }})"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                    @include('admin.__pertials.delete-form', ['actionUrl' => route('admin.faq.destroy', $item->id), 'formId' => 'deleteForm'.$item->id])
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4"><h5 class="empMsg">NO FAQ FOUND!</h5></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-center">
                {{ $data->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
