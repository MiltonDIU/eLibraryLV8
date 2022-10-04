@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="title">{{$item->title}}({{$item->users_count}})
                     @foreach($item->department as $dep)
                        <small class="badge badge-danger"> {{$dep->deptShortName}}</small>
                     @endforeach
                     </h4>
                </div>
                <div class="card-body">

                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="dataTables" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Date and Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $loop->iteration or $user->id }}

                                    </td>
                                    <td>
                                        {{$user->user->displayName}}

                                    </td>
                                     <td>
                                    
                                          <small class="badge badge-success"> {{$user->user->deptName}}</small>
                                     
                                  </td>
                                    
                                    
                                    
                                    <td>{{$user->created_at}}</td>
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
        $(document).ready(function () {
            $('#dataTables').DataTable({
                columnDefs: [
                    {
                        targets: [0, 1, 2],
                        className: 'mdl-data-table__cell--non-numeric',

                    }
                ],
                "order": [[0, 'desc']]

            });
        });
    </script>
@endpush

@include('notification.notify')