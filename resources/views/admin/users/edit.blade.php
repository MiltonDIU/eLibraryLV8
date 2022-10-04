@extends('layouts.master')

@section('content')
    <div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <a href="{{ url('/admin/users') }}" title="Back">
                    <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button>
                </a>
                <br/>
                <br/>


                {!! Form::model($user, [
                                           'method' => 'PATCH',
                                           'url' => ['/admin/users', $user->id],
                                           'class' => 'form-horizontal',
                                           'files' => true
                                       ]) !!}
                @include ('admin.users.form', ['submitButtonText' => 'Update'])

                {!! Form::close() !!}


            </div>
        </div>
    </div>
    </div>
@endsection
