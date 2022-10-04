@extends('layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Issue Tracking #{{ $issuetracking->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/issue-tracking') }}" title="Back">
                        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </button>
                    </a>
                    <br/>
                    <br/>

                    {!! Form::model($issuetracking, ['method' => 'PATCH','url' => ['admin/issue-tracking', $issuetracking->id],'class' => 'form-horizontal','files' => true]) !!}

                    @include ('admin.issue-tracking.form',['submitButtonText' => 'Update'])

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

@endsection
