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
                                    <th> Semester Name</th>
                                    <td> {{ $item->name }} </td>
                                </tr>
                                <tr>
                                    <th> Semester Code</th>
                                    <td> {{ $item->code }} </td>
                                </tr>
                                <tr>
                                    <th> Semester Year</th>
                                    <td> {{ $item->semester_year }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
