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
                                    <a href="{{url('feedback/new')}}" class="btn btn-primary new-feedback ">New</a>
                                </div>
                                <!-- BEGIN FORM-->

                                {!! Form::open(['url' => '/admin/issue-tracking', 'class' => 'form-horizontal', 'files' => true]) !!}


                                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                    <label for="title">Subject</label>
                                    {!! Form::text('title', null, ['class' => 'form-control margin-bottom-15', 'required' => 'required','maxlength'=>'100']) !!}
                                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                </div>


                                <div class="form-group {{ $errors->has('comments') ? 'has-error' : ''}}"><label
                                            for="contacts-message">Message</label>
                                    {!! Form::textarea('comments', null, ['class' => 'form-control margin-bottom-15', 'rows'=>'5', 'required' => 'required','maxlength'=>'250']) !!}
                                    {!! $errors->first('comments', '<p class="help-block">:message</p>') !!}
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Send</button>
                                <button type="reset" class="btn btn-default">Cancel</button>
                            {!! Form::close() !!}
                            <!-- END FORM-->
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