@extends('layouts.master')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/semester') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if(Session::has('viewIndex'))
                            @include('admin.action')
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th> Department</th>
                                    <td> {{ $item->department->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $item->name }} </td>
                                </tr>
                                <tr>
                                    <th> Email</th>
                                    <td> {{ $item->email }} </td>
                                </tr>
                                <tr>
                                    <th> Mobile</th>
                                    <td> {{ $item->mobile }} </td>
                                </tr>
                                <tr>
                                    <th> Employee ID</th>
                                    <td> {{ $item->mobile }} </td>
                                </tr>
                                <tr>
                                    <th> Designation</th>
                                    <td> {{ $item->designation }} </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                <th>SL-No</th>
                                <th>Project Title</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($item->itemSemesterSupervisor as $itemSemesterSupervisor)
                                   <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$itemSemesterSupervisor->item->title}}</td>
                                       @if(Session::has('viewIndex'))
                                           @include('admin.action')
                                       @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
