@extends('layouts.master')

@section('content')

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('admin/service-category') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
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
                                    <th> ServiceCategory</th>
                                    <td> {{ $item->serviceCategory }} </td>
                                </tr>
                                <tr>
                                    <th> Image</th>
                                    <td> {{ $item->image }} </td>
                                </tr>
                                <tr>
                                    <th> ServiceCategorySort</th>
                                    <td> {{ $item->serviceCategorySort }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection
