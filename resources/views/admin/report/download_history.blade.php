@extends('layouts.master')

@section('content')

  <div class="row">
      <div class="col-md-12"><a href="{{url('admin/report/highest-download-books')}}">List of Download Highest Book </a> </div>
  
      <div class="col-md-12">
          <div class="card">
              <div class="card-body">

                  <br/>
                  <br/>
                  <div class="table-responsive">
                      <table id="dataTables" class="table table-borderless">
                          <thead>
                          <tr>
                              <th>Sl.No</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Roles</th>
                              <th>Number of Download</th>

                          </tr>
                          </thead>
                          <tbody>
                          @foreach($users as $user)
                              <tr>
                                  <td>
    {{ $loop->iteration or $user->id }}

                                  </td>
                                  <td>
                                      <a href="{{url('admin/report/download-history',$user->id)}}">
                                          {{ $user->displayName }}
                                      </a>

                                     </td>
                                  <td>{{ $user->email }}</td>

                                  <td>
                                      @foreach($user->role as $role)
                                          {{$role->name}},
                                      @endforeach
                                  </td>
                                  <td>{{ $user->items_count }} out of {{ $user->download }}</td>
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
                "order": [[0, 'asc']]

            });
        });
    </script>
@endpush

@include('notification.notify')