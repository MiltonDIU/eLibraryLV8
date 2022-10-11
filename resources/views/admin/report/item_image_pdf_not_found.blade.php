@extends('layouts.master')

@section('content')

  <div class="row">
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
                              <th>Title</th>
                              <th>Name</th>
                              <th>Department</th>
                              <th>Created Time</th>
                              <th>Update Time</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($data as $key=> $item)
                              <tr>
                                  <td>
{{++$key}}
                                  </td>
                                  <td>
                                      {{$item->title}}

                                     </td>
                                  <td>{{ $item->user->displayName }}</td>

                                  <td>
                                      @foreach($item->department as $dep)
                                          {{$dep->departmentName}},
                                      @endforeach
                                  </td>
                                  <td>{{$item->created_at}}</td>
                                  <td>{{$item->updated_at}}</td>
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
