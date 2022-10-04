@extends('layouts.master')

@section('content')
    <div class="row">

        <div class="m-heading-1 border-green m-bordered">
            <div class="todo-tasklist">
                <div class="todo-tasklist-item todo-tasklist-item-border-green">

                    @php
                        $img =  $item->user->imageIcon? $item->user->imageIcon:'adminpic.png';
                    @endphp
                    <img class="todo-userpic pull-left" src="{{url('uploads/profile/icon',$img)}}" width="27px"
                         height="27px">
                    <div class="todo-tasklist-item-title"> {{$item->user->displayName}} </div>


                    <div class="todo-tasklist-item-text"><strong>{!! $item->title !!}</strong></div>
                    <div class="todo-tasklist-item-text"> {!! $item->comments !!} </div>
                    <div class="todo-tasklist-controls pull-left">
                                    <span class="todo-tasklist-date">
                                        <i class="fa fa-calendar"></i>
                                        {{ date_create($item->created_at)->format('d M Y, h:i:s A')}} </span>
                        <br>

                        <span class="bg-red-pink">Create By: {!! $item->user->displayName !!}</span>
                        <span class="bg-red-pink">Assign To: {!! Service::assignTo($item->assignTo) !!}</span>
                        <span class="bg-red-flamingo">Assign By: {!! Service::assignBy($item->assignBy) !!}</span>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <!-- BEGIN TODO SIDEBAR -->
            <div class="todo-ui">
                <!-- BEGIN TODO CONTENT -->
                <div class="todo-content">
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-8 col-sm-7">
                                    @foreach($item->issueTrackingDetail as $issue)

                                        <div class="todo-tasklist {!! Auth::user()->id==$issue->user->id?" col-sm-10 self-comment ":"col-sm-10" !!}">
                                            <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                                @php
                                                    $img =  $issue->user->imageIcon? $issue->user->imageIcon:'adminpic.png';
                                                @endphp

                                                <img class="todo-userpic pull-left"
                                                     src="{{url('uploads/profile/icon',$img)}}" width="27px"
                                                     height="27px">

                                                <div class="todo-tasklist-item-title"> {{$issue->user->displayName}} </div>
                                                <div class="todo-tasklist-item-text"> {!! $issue->actionComments  !!} </div>
                                                <div class="todo-tasklist-controls pull-left">

                                    <span class="todo-tasklist-date">
                                        <i class="fa fa-calendar"></i>
                                        {{ date_create($issue->created_at)->format('d M Y, h:i:s A')}} </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="todo-tasklist-devider"></div>
                                <div class="col-md-4 col-sm-5">
                                    @if(!$item->isCompleted==1)
                                        {!! Form::open(['url' => '/admin/issue-tracking/feedback', 'class' => 'form-horizontal', 'files' => true]) !!}
                                        <div class="form-group {{ $errors->has('actionComments') ? 'has-error' : ''}}">
                                            <div class="col-md-12">
                                                {!! Form::textarea('actionComments', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                {!! Form::hidden('issue_tracking_id',$item->id, null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                @if(isset($item->assignTo))
                                                    @if($item->assignTo==Auth::user()->id)
                                                        <div class="form-group">
                                                            <div class="mt-checkbox-list">
                                                                <label class="mt-checkbox mt-checkbox-outline"> Is
                                                                    Complete
                                                                    <input type="checkbox" value="1"
                                                                           name="isCompleted"/>
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                {!! $errors->first('actionComments', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-4">
                                                <input class="btn btn-primary" type="submit" value="Submit">
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    @elseif($item->isCompleted==1 and !$item->rating_id==null)
                                        {{ $item->rating_id }}
                                    @else
                                        @if($item->user_id==Auth::id())
                                            {!! Form::model($issuetracking, ['method' => 'PATCH','url' => ['admin/issue-tracking/rating', $item->id],'class' => 'form-horizontal','files' => true]) !!}
                                            <div class="form-group {{ $errors->has('rating_id') ? 'has-error' : ''}}">
                                                <div class="col-md-6">
                                                    <div class="mt-radio-inline">
                                                        @foreach($ratings as $rating)
                                                            <label class="mt-radio">
                                                                {{ Form::radio('rating_id',$rating->id) }}
                                                                {{$rating->ratingName}}
                                                                <span></span>
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                    {!! $errors->first('rating_id', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-4 col-md-4">
                                                    <input class="btn btn-primary" type="submit" value="Submit">
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        @else
                                            {{"Your rating is not yet!"}}
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{url('assets/admin/apps/css/todo-2.min.css')}}"/>
@endpush
@push('scripts')
    <script src="{{url('assets/admin/apps/scripts/todo-2.min.js')}}" type="text/javascript"></script>
@endpush
@include('notification.notify')