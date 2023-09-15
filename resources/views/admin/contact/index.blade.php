@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Contact Message</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Message Date</th>
                        <th>Message</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($contacts))
                        @foreach ($contacts as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ date('Y-m-d H:i A', strtotime($data->created_at)) }}</td>
                                <td>{{ Str::limit($data->message, 100) }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('admin.contact.show', $data->id) }}"><i class="fa fa-eye m-r-5"></i>View Info</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_appointment"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="text-center">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
