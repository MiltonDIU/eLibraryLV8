@extends('layouts.master')

@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="col-md-12"><a href="{{url('admin/report/download-history')}}">List of Download Highest User </a> </div>
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

                              <th>Number of Download</th>
                              <th>Service Type</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($books as $book)
                              <tr>
                                  <td>
    {{ $loop->iteration or $book->id }}
                                  </td>
                                  <td>
                                      <a href="{{url('admin/report/highest-download-books-with-user-list',$book->id)}}">
                                          {{ $book->title }}
                                      </a>

                                     </td>

                                  <td>{{ $book->users_count }}</td>
                                  <th>{{$book->category->itemCategory}}</th>
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