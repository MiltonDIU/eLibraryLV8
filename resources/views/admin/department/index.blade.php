@extends('layouts.master')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/department/create') }}" class="btn btn-success btn-sm" title="Add New department">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table id="dataTables" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>Department Name</th>
                                        <th>Department Short Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($departments as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->departmentName }}</td><td>{{ $item->deptShortName }}</td>
                                        <td>
                                            <a href="{{ url('/admin/department/' . $item->id) }}" title="View department"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('admin/department/' . $item->id . '/edit') }}" title="Edit department"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/department' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete department"
                                                        onclick="return confirm(&quot;Confirm; delete?;&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{url('assets/datatable/css/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/datatable/css/dataTables.material.min.css')}}"/>
@endpush
@push('scripts')
    <script type="text/javascript" src="{{url('assets/datatable/js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/datatable/js/dataTables.material.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable( {
                columnDefs: [
                    {
                        targets: [ 0, 1, 2 ],
                        className: 'mdl-data-table__cell--non-numeric',

                    }
                ],
                "order": [[ 0, 'desc' ]]

            } );
        } );
    </script>
@endpush
@include('notification.notify')