@extends('layouts.master')

@section('content')
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/a2z-database') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                        @if(Session::has('viewIndex'))
                            @include('admin.action')
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                <tr>
                                    <th> A2zTitle</th>
                                    <td> {{ $item->a2zTitle }} </td>
                                </tr>
                                <tr>
                                    <th> A2zDescription</th>
                                    <td> {{ $item->a2zDescription }} </td>
                                </tr>
                                <tr>
                                    <th> Trial</th>
                                    <td> {{ $item->trial }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection
