@extends('layouts.master')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <a href="{{ url('/admin/item') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />


                        {!! Form::open(['url' => '/admin/item', 'class' => 'form-horizontal', 'files' => true,'id'=>'item-form']) !!}

                            @include ('admin.item.form')


{!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>

@endsection
