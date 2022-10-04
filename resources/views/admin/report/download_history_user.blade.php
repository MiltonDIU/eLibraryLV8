@extends('layouts.master')

@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="card">

              <div class="card-header">
                  <h4 class="title">{{$user->displayName}}({{$user->items_count}})</h4>
              </div>
              <div class="card-body">

                  <br/>
                  <br/>
                  <div class="table-responsive">
                      <table id="dataTables" class="table table-borderless">
                          <thead>
                          <tr>
                              <th>Sl.No</th>
                              <th>Title of Books</th>
                              <th>Department</th>
                              <th>Service</th>
                              <th>Date </th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($items as $item)
                              <tr>
                                  <td>
    {{ $loop->iteration or $item->id }}

                                  </td>
                                  <td>
                                      {{$item->item->title}}

                                     </td>

                                  <td>
                                    @foreach($item->item->department as $dep)

                                          <small class="badge badge-success"> {{$dep->deptShortName}}</small>
                                      @endforeach
                                  </td>
                                  <td>
                                      {{$item->item->category->itemCategory}}
                                  </td>

                                  <td>
                                      {{ date_create($item->created_at)->format('d-m-Y, h:i:s A')}}

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