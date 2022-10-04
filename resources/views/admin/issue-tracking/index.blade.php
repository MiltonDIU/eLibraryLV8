@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Issue Tracking</div>
                <div class="card-body">
                    <a href="{{ url('/admin/issue-tracking/create') }}" class="btn btn-success btn-sm"
                       title="Add New IssueTracking">
                        <i class="fa fa-plus" aria-hidden="true"></i> New Issue
                    </a>

                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table id="dataTables" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Title of Comments</th>
                                <th>Comments</th>
                                <th>Comments Author</th>
                                <th>Assign To</th>
                                <th>Assign By</th>
                                <th>Number of Message</th>
                                <th>Date and Time</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($issuetracking as $issue)
                                <tr>
                                    <td>{{ $issue->id }}</td>
                                    <td>{{ $issue->title }}
                                        @if($issue->assignTo==null)
                                            <span class="badge badge-default bg-green">New</span>
                                        @endif
                                    </td>
                                    <td>{{  substr($issue->comments, 0, 60) . '..' }}</td>
                                    <td>{{ $issue->user->displayName }}</td>
                                    <td>
                                        {!! Service::assignTo($issue->assignTo) !!}
                                    </td>
                                    <td>{!! Service::assignBy($issue->assignBy) !!}</td>
                                    <td>
                                    <span class="bg-green">
                                        {!! Service::feedbackCount($issue->id) !!}
                                        <br>
                                        @if($issue->isCompleted==!null)
                                            Completed
                                        @endif
                                    </span>
                                    </td>
                                    <td>{{$issue->created_at}}</td>
                                    <td>
                                        <a href="{{ url('/admin/issue-tracking/' . $issue->id) }}"
                                           title="View IssueTracking">
                                            <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/admin/issue-tracking/' . $issue->id . '/edit') }}"
                                           title="Edit IssueTracking">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Edit
                                            </button>
                                        </a>

                                        <form method="POST"
                                              action="{{ url('/admin/issue-tracking' . '/' . $issue->id) }}"
                                              accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Delete IssueTracking"
                                                    onclick="return confirm(&quot;Confirm; delete?;&quot;)"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                        <a class="btn blue btn-outline sbold" data-toggle="modal"
                                           href="#assignTo{{$issue->id}}"> Assign To </a>

                                        <div class="modal fade bs-modal-sm" id="assignTo{{$issue->id}}" tabindex="-1"
                                             role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                        <h4 class="modal-title">Assign To</h4>
                                                    </div>
                                                    {!! Form::open(['url' => '/admin/issue-tracking/assignTo', 'class' => 'form-horizontal', 'files' => true]) !!}
                                                    <div class="modal-body">
                                                        <div class="form-group" style="margin-left:0px">

                                                            <select name="assignTo" class="form-control input-medium">
                                                                <option> Assign to......</option>
                                                                @foreach($assignTo as $assign)
                                                                    <option value="{{$assign->user_id}}">{{$assign->displayName}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" value="{{$issue->id}}" name="id">
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline"
                                                                data-dismiss="modal">Close
                                                        </button>


                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <input class="btn btn-primary" type="submit"
                                                                       value="Assign To">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        @if(isset($issue->assignTo))
                                            <span class="bg-purple">{{\App\User::find($issue->assignTo)->name}}</span>
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