@extends('layouts.master')

@section('content')
    <div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <a href="{{ url('/admin/roles') }}" title="Back">
                    <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button>
                </a>
                <br/>
                <br/>

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif


                {!! Form::model($role, [
                               'method' => 'PATCH',
                               'url' => ['/admin/roles', $role->id],
                               'class' => 'form-horizontal',
                               'files' => true
                           ]) !!}

                @include ('admin.roles.form', ['submitButtonText' => 'Update'])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
@endsection
