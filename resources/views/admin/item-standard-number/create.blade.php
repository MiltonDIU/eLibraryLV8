@extends('layouts.master')

@section('content')
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/item-standard-number') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        {!! Form::open(['url' => '/admin/item-standard-number', 'class' => 'form-horizontal', 'files' => true]) !!}

                            @include ('admin.item-standard-number.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

@endsection
