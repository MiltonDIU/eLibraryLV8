@extends('layouts.master')

@section('content')
        <div class="row">
            <div class="col-md-12">
                @foreach ($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/semester') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                            {!! Form::open(['url' => '/admin/supervisor', 'class' => 'form-horizontal', 'files' => true]) !!}

                            @include ('admin.supervisor.form')

                       {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

@endsection
