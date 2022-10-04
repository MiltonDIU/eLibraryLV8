@extends('layouts.master')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">


                        @if(Session::has('create'))
                            <a href="{{ url('/admin/a2z-database/create') }}" class="btn btn-success btn-sm"
                               title="Add New A2zDatabase">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                        @endif


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table id="dataTables" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>A2zTitle</th>
                                        <th>A2zDescription</th>
                                        <th>Subject</th>
                                        <th>Vendor</th>
                                        <th>Trial</th>

                                        @if(Session::has('viewIndex'))
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($a2zdatabase as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->a2zTitle }}</td>
                                        <td>
                                            {{substr($item->a2zDescription, 0, 120)}}
                                        </td>
                                        <td>
                                            @foreach($item->a2zSubject as $subject)
                                                {{$subject->a2zSubjectName}},
                                            @endforeach
                                        </td>
                                        <td>{{$item->a2zVendor->a2zVendorName}}</td>
                                        <td>{{ $item->trial }}</td>
                                        <td>
                                            @if(Session::has('viewIndex'))
                                                @include('admin.action')
                                            @endif
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