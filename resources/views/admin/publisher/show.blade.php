@extends('layouts.master')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ url('/admin/publisher') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @if(Session::has('viewIndex'))
                            @include('admin.action')
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th> PublisherName</th>
                                    <td> {{ $item->publisherName }} </td>
                                </tr>
                                <tr>
                                    <th> PublisherPhone</th>
                                    <td> {{ $item->publisherPhone }} </td>
                                </tr>
                                <tr>
                                    <th> PublisherEmail</th>
                                    <td> {{ $item->publisherEmail }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
