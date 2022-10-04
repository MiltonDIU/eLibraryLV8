@extends('layouts.front_end')

@section('content')

    <div class="main">
        <div class="container">
        @include('frontend.partial.breadcrumb')
        <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <div class="content-page">
                        <div class="row">
                            <div class="col-md-9 col-sm-9">
                                <div class="margin-bottom-15">
                                    <a href="{{url('feedback/new')}}" class="btn btn-primary new-feedback">New</a>
                                </div>
                                <div id="accordion1" class="panel-group">


                                    @foreach($issuetracking as $issue)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">

                                                    <a class="accordion-toggle collapsed {!! $issue->unread2initiator==1?"unread":"" !!}"
                                                       data-toggle="collapse"
                                                       data-parent="#accordion{{$issue->id}}"
                                                       href="#accordion1_{{$issue->id}}">

                                                        {{$issue->title}}
                                                    </a>

                                                </h4>
                                            </div>
                                            <div style="height: 0px;" id="accordion1_{{$issue->id}}"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">

                                                    <blockquote>
                                                        <p>{!! $issue->comments !!}</p>

                                                        @if($issue->rating_id==0)
                                                            <span>
                            <a class="btn blue btn-outline sbold" data-toggle="modal" href="#issues{{$issue->id}}">
                                    {!! ($issue->isCompleted==0)?"Message":"Ratting" !!}
                                                                                                                            </a>
                        </span>
                                                        @else
                                                            Your Ratting Point is : {{$issue->rating_id}}
                                                        @endif

                                                    </blockquote>

                                                    <div class="comments">

                                                        @foreach($issue->issueTrackingDetail as $itd)
                                                            @php
                                                                $img = $itd->user->imageIcon? $itd->user->imageIcon:'adminpic.png';
                                                            @endphp
                                                            <div class="media">
                                                                <a href="javascript:" class="pull-left">
                                                                    <img src="{{url('uploads/profile/icon',$img)}}"
                                                                         alt="" class="media-object">
                                                                </a>
                                                                <div class="media-body">

                                                                    <h4 class="media-heading">{{$itd->user->displayName}} </h4>

                                                                    <div class="modal fade bs-modal-sm"
                                                                         id="issues{{$issue->id}}" tabindex="-1"
                                                                         role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-hidden="true"></button>
                                                                                    <h4 class="modal-title">

                                                                                        {!! ($issue->isCompleted==0)?"Message":"Ratting" !!}

                                                                                    </h4>
                                                                                </div>
                                                                                @if($issue->isCompleted==0)
                                                                                    {!! Form::open(['url' => '/admin/issue-tracking/feedback', 'class' => 'form-horizontal', 'files' => true]) !!}
                                                                                    <div class="modal-body">
                                                                                        <div class="form-group">
                                                                                            {!! Form::textarea('actionComments', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                                                            {!! Form::hidden('issue_tracking_id',$issue->id, null, ['class' => 'form-control', 'required' => 'required']) !!}

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <div class="form-group">
                                                                                            <div class="col-md-offset-4 col-md-4">
                                                                                                <input class="btn btn-primary"
                                                                                                       type="submit"
                                                                                                       value="Submit">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    {!! Form::close() !!}
                                                                                @endif
                                                                                @if($issue->isCompleted==1)
                                                                                    @if($issue->user_id==Auth::id())
                                                                                        {!! Form::open(['method' => 'PATCH','url' => ['admin/issue-tracking/rating', $issue->id],'class' => 'form-horizontal','files' => true]) !!}
                                                                                        <div class="form-group {{ $errors->has('rating_id') ? 'has-error' : ''}}">
                                                                                            <div class="col-md-6">
                                                                                                <div class="mt-radio-inline">
                                                                                                    @foreach($ratings as $rating)

                                                                                                        {{ Form::radio('rating_id',$rating->id) }}
                                                                                                        {{$rating->ratingName}}
                                                                                                        <span></span>

                                                                                                    @endforeach
                                                                                                </div>

                                                                                                {!! $errors->first('rating_id', '<p class="help-block">:message</p>') !!}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <div class="col-md-offset-4 col-md-4">
                                                                                                <input class="btn btn-primary"
                                                                                                       type="submit"
                                                                                                       value="Submit">
                                                                                            </div>
                                                                                        </div>
                                                                                        {!! Form::close() !!}
                                                                                    @endif
                                                                                @endif

                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->
                                                                    </div>

                                                                    <p>{!! $itd->actionComments !!} </p>
                                                                    <i class="fa fa-calendar"></i> {{ date_create($issue->created_at)->format('d M Y, h:i:s A')}}
                                                                </div>
                                                            </div>


                                                        @endforeach
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>

                            @include('frontend.partial.sidebar')
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@endsection
@include('notification.notify')