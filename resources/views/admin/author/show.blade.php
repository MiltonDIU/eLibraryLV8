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
                <span>View Author</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->

    <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/author') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if(Session::has('viewIndex'))
                            @include('admin.action')
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                <tr>
                                    <th> AuthorName</th>
                                    <td> {{ $item->authorName }} </td>
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
