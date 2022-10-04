@extends('layouts.front_end')

@section('content')
    <!-- Header END -->
    <div class="main">
        <div class="container">
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!---search box---->
            @include('frontend.partial.advance_search')
            <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-12">
                    <div class="content-form-page">
                        <div class="row">

                           {!! FrontEnd::services() !!}


                        </div>
                    </div>
                </div>
            @include('frontend.partial.sidebar')
            <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @include('frontend.partial.latest_book')

@endsection
@include('frontend.partial.service-css')

