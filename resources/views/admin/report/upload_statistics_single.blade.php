@extends('layouts.master')
@section('content')

    <style>
        .center {
            margin: auto;
            width: 100%;
            padding: 10px;
            text-align: center;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 center">
                            <img src="http://203.190.10.202/member/assets/image/logo.png" alt="logo" align="center"><br>
                           <h3>Daffodil International University</h3>
                            <span>Upload Statistics Report for {{$dateSelect}}</span>
                        </div>
                        <div class="col-md-12 center">
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </ul>
                                @endif
                                {!! Form::open(['url' => 'admin/report/upload-statistics', 'class' => 'form-horizontal form-bordered', 'files' => false]) !!}


                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-md-offset-1">Select Date Ranges</label>
                                        <div class="col-md-4">
                                            <div class="input-group" id="defaultrange">

                <input type="text" name="date_select" value="{{ old('date_select') }}" class="form-control", required="required">
                                                <span class="input-group-btn">
                                                                <button style="padding: 9px 12px" class="btn default date-range-toggle" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                 <input class="btn btn-primary" name="btnResult" type="submit" value="resultView">
                 <input class="btn green" name="btnResult" type="submit" value="PDF-Download">
                                                <br>
                                                <br>
                 <input class="btn green" name="btnResult" type="submit" value="Word-Download">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group {{ $errors->has('userWise') ? 'has-error' : ''}}">
                                {!! Form::label('userWise', 'Library Personal Report', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    <input type="checkbox" id="userWise" name="userWise">
                                </div>
                            </div>
                            <div id="userList" class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                                {!! Form::label('user_id', 'Users', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('user_id',$users,null,['class' => 'form-control','placeholder'=>'Select an User','id'=>'user_id']) !!}

                                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>


                        {!! Form::close() !!}
                            <!-- END FORM-->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTables" class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>User ID/Email</th>
                                <th>IP</th>
                                <th>Title</th>
                                <th>Service Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $i=1;
                            $j=1;
                            @endphp
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->user->diu_id }}</td>
                                    <td>{{ $item->ip_address }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category->itemCategory }}</td>
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

@push('style_plugins')
    <link href="{{url('assets/admin/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/admin/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/admin/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/admin/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css" />
    @endpush
@push('styles')

    @endpush



@push('scripts_plugins')
    <script src="{{url('assets/admin/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
    @endpush
@push('scripts')

    <script src="{{url('assets/admin/pages/scripts/components-date-time-pickers.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $("#userWise").click(function(){
                $("#userList").toggle('slow');
            });
        });

    </script>
    @endpush

@include('notification.notify')
<style>
    #userList{
        display: none;}
</style>