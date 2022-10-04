@extends('layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">New Issue</div>
                <div class="card-body">
                    <a href="{{ url('/admin/issue-tracking') }}" title="Back">
                        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </button>
                    </a>
                    <br/>
                    <br/>
                    {!! Form::open(['url' => '/admin/issue-tracking', 'class' => 'form-horizontal', 'files' => true]) !!}

                    @include ('admin.issue-tracking.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
