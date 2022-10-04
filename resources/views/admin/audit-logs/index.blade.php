@extends('layouts.master')

@section('content')

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Audit Logs</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTables" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>DIU ID</th>
                                <th>Service Category</th>
                                <th>Service Name</th>
                                <th>User Role</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->displayName }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>{{ $item->user->diu_id }}</td>
                                    <td>{!! Service::serviceCategory($item->service->service_category_id) !!}</td>
                                    <td>{{ $item->service->action }}</td>
                                    <td>
                                        @foreach($item->user->role->pluck('name') as $role)
                                            {{$role}},
                                        @endforeach
                                    </td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! $logs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
