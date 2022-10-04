@extends('layouts.master')

@section('content')
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">User {{ $item->name }}</div>
            <div class="card-body">

                <a href="{{ url('/admin/users') }}" title="Back">
                    <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button>
                </a>
                @if(Session::has('viewIndex'))
                    @include('admin.action')
                @endif
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>

                        <tr>
                            <th> Name</th>
                            <td> {{ $item->name }} </td>
                        </tr>
                        <tr>
                            <th> Email</th>
                            <td> {{ $item->email }} </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
