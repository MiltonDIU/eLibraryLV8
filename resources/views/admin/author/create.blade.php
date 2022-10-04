@extends('layouts.master')

@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/author')}}">Authors</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>New Author</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->



    <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/author') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                       {!! Form::open(['url' => '/admin/author', 'class' => 'form-horizontal', 'files' => true]) !!}
                            @include ('admin.author.form')
                       {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

@endsection
