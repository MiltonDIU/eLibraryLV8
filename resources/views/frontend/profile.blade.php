@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img alt="" class="img-responsive"  src="{{url('uploads/profile/icon',Auth::user()->imageIcon)}}"/>
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{$user->displayName}} </div>
                        <hr>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->

                </div>
                <!-- END PORTLET MAIN -->
                <!-- PORTLET MAIN -->
                <div class="portlet light ">
                    <!-- STAT -->
                    <div class="row list-separated profile-stat">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> {!! FrontEnd::itemUserDownloadCount($user->id) !!} </div>
                            <div class="uppercase profile-stat-text"> Downloads</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title">
                                <a href="{{url('feedback')}}">
                                    {!! FrontEnd::getFeedbackCount($user->id) !!}
                                </a>

                            </div>
                            <div class="uppercase profile-stat-text"><a href="{{url('feedback')}}">Create Feedback</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title">
                                <a href="{{url('feedback')}}">
                                    {!! FrontEnd::getMessageCount($user->id) !!}
                                </a>
                            </div>
                            <div class="uppercase profile-stat-text"><a href="{{url('feedback')}}">Feedback Messages</a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Activities</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> Profile </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> Downloads </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> Messages </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 320px;" data-always-visible="1"
                                                 data-rail-visible1="0" data-handle-color="#D7DCE2">
                                               <div class="row">
                                                   <div class="col-md-8">
                                                       <ul class="feeds">
                                                           <li>
                                                               <div class="col-md-12">
                                                                   <span>Name: {{$user->displayName}}</span>
                                                               </div>
                                                               <div class="col-md-12">
                                                                   <span>Email:{{$user->email}}</span>
                                                               </div>

                                                               <div class="col-md-12">
                                                                   <span>Mobile:{{$user->mobile}}</span>
                                                               </div>
                                                               <div class="col-md-12">
                                                                   <span>Department:{{$user->deptName }}</span>
                                                               </div>
                                                               <div class="col-md-12">
                                                                   <span>Designation:{{$user->designation }}</span>
                                                               </div>
                                                           </li>
                                                       </ul>
                                                   </div>
                                                   <div class="col-md-4">
                                                       <img alt="" width="150" class=""
                                                            src="{{url('uploads/profile/icon',Auth::user()->imageIcon)}}"/>
<br>
                                                   <a href="#" id="profile-picture">Change Profile picture</a>

                                                       <div class="" id="upload_profile_picture">
                                                           {!! Form::open([
                                                                           'route' => 'dashboard.user.avatarUpdate',
                                                                           'class' => 'form-horizontal',
                                                                           'files'=>true
                                                                           ])
                                                                       !!}
                                                           <div class="form-group row">

                                                               <div class="col-md-12 avatar">
                                                                   <input id="avatar" type="file" class="form-control {{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar" required>

                                                                   @if ($errors->has('avatar'))
                                                                       <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                                                   @endif
                                                               </div>
                                                           </div>

                                                           <div class="form-group">
                                                               <div class="col-md-offset-2 col-md-10">
                                                                   {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                                               </div>
                                                           </div>

                                                           {!! Form::close() !!}
                                                       </div>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_2">
                                            <div class="scroller" style="height: 337px;" data-always-visible="1"
                                                 data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                <ul class="feeds">

                                                    @foreach($user->item as $item)
                                                        <li>
                                                            <div class="col1">

                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-primary">
                                                                            <i class="fa fa-download"></i>
                                                                        </div>

                                                                        <div class="desc"> {{$item->title}}
                                                                            @if(isset($item->itemUser))
                                                                                @foreach ($item->itemUser as $itemUser)
                                                                                    <span class="label label-sm label-danger ">
        {{ date_create($itemUser->created_at)->format('d M Y')}}

                                                                                        {{ date_create($itemUser->created_at)->format('h:i')}}
                                                                                        mins
    </span>
                                                                                    &nbsp;
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_3">
                                            <div class="scroller" style="height: 337px;" data-always-visible="1"
                                                 data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                <ul class="feeds">

                                                    <li>
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-7">
                                                                @foreach($issueTracking as $issue)

                                                                    <div class="todo-tasklist {!! Auth::user()->id==$issue->user->id?" col-sm-10 self-comment ":"col-sm-10" !!}">
                                                                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                                                            @php
                                                                                $img =  $issue->user->imageIcon? $issue->user->imageIcon:'adminpic.png';
                                                                            @endphp

                                                                            <img class="todo-userpic pull-left"
                                                                                 src="{{url('uploads/profile/icon',$img)}}"
                                                                                 width="27px"
                                                                                 height="27px">

                                                                            <div class="todo-tasklist-item-title"> {{$issue->user->displayName}} </div>


                                                                            @foreach($issue->issueTrackingDetail as $issueTrack)
                                                                                <div class="todo-tasklist-item-text">
                                                                                    {!! $issueTrack->actionComments !!}

                                                                                </div>
                                                                            @endforeach


                                                                            <div class="todo-tasklist-controls pull-left">

                                <span class="todo-tasklist-date">
                                    <i class="fa fa-calendar"></i>
                                    {{ date_create($issue->created_at)->format('d M Y, h:i:s A')}} </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{url('assets/admin/pages/css/profile.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        #upload_profile_picture{display: none}
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){
            $("#profile-picture").click(function(){
                $("#upload_profile_picture").toggle('slow');
            });
        });
    </script>
    @endpush