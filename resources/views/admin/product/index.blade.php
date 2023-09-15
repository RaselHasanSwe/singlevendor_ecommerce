@extends('admin.layout.app')

@section('style')
<style>
    .select2-container .select2-selection--single {
        height: 50px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 50px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        top:67% !important;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <nav aria-label="breadcrumb">
            <h4 class="">PRODUCT LIST</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.product.index') }}">Product</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Create Product</a>
    </div>
</div>
<hr/>
<form method="get">
    <div class="row filter-row">
        <div class="col-sm-2 col-md-2">
            <div class="form-group">
                <input type="text" placeholder="Search" name="key" class="form-control" value="{{ request()->key }}" style="height: 50px">
            </div>
        </div>
        <div class="col-sm-2 col-md-2">
            <div class="form-group">
                <select class="form-control select filter-select" name="category_id" id="category">
                    <option value="">select category</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}" {{ request()->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-2 col-md-2">
            <div class="form-group">
                <select class="form-control select" name="sub_category_id" id="sub_category">
                    <option value="">select sub category</option>
                    @if(isset($sub_category))
                        @foreach ($sub_category as $item)
                            <option value="{{ $item->id }}" {{ request()->sub_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-sm-2 col-md-2">
            <div class="form-group">
                <select class="form-control select" name="inner_category_id" id="inner_category">
                    <option value="">select inner category</option>
                    @if(isset($inner_category))
                        @foreach ($inner_category as $item)
                            <option value="{{ $item->id }}" {{ request()->inner_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-sm-2 col-md-2">
            <div class="form-group">
                <select class="form-control select" name="status" id="status">
                    <option value="">status</option>
                    <option value="1" {{ request()->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ isset(request()->status) && request()->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>


        <div class="col-sm-6 col-md-1">
            <button type="submit" class="btn btn-info"> Search </button>
        </div>
        <div class="col-sm-6 col-md-1">
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-block"> Reset </a>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>SKU</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Discount</th>

                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr>
                            <td>{{ $index + $data->firstItem() }}</td>
                            <td><img class="" src="{{ ImageViewer::show($item->thumbnail, 'sm-') }}" width="40"></td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $item?->category?->name }}
                                @if($item?->subCategory?->name)
                                -> {{ $item?->subCategory?->name }}
                                @endif
                                @if($item?->innerCategory?->name)
                                -> {{ $item?->innerCategory?->name }}
                                @endif

                            </td>
                            <td>{{ $item->sku }}</td>
                            <td>{{ number_format($item->stock, 2) }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>
                                @if($item->discount)
                                    {{ number_format($item->discount, 2) }}
                                    {{ $item->discount_type == 1 ? '%' : ''}}
                                @endif
                            </td>
                            <td>
                                <select class="form-control select" name="status" onchange="active('{{ $item->id }}')">
                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive </option>
                                </select>
                            </td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('admin.product.edit', $item->id) }}"><i class="fa fa-edit m-r-5"></i>Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_appointment" onclick="deleteAlert({{ 'deleteForm'.$item->id }})"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                    @include('admin.__pertials.delete-form', ['actionUrl' => route('admin.product.destroy', $item->id), 'formId' => 'deleteForm'.$item->id])
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="11"><h5 class="empMsg">NO PRODUCT FOUND!</h5></td>
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
<script>
    $(document).on('change', '#category', function(){
        let id = $(this).val();
        let url = "{{ route('admin.sub-category.show', ":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: url,
            success: function(response) {
                $('#sub_category').html(response);
            }
        });
    })

    // get inner category
    $(document).on('change', '#sub_category', function(){
        let id = $(this).val();
        let url = "{{ route('admin.inner-category.show', ":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: url,
            success: function(response) {
                $('#inner_category').html(response);
            }
        });
    })

    function active(id)
    {
        if(id == '') return false;
        var data = new FormData();
        data.append('_token', '{{ csrf_token() }}')
        data.append('id', id)
        $.ajax({
            processData: false,
            contentType: false,
            data: data,
            type: 'POST',
            url: "{{ route('admin.product.active') }}",
            success: function(response) {
                toastr.success(response, "Success");
            }
        });
    }
</script>
@endsection
