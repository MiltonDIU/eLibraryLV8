@extends('layouts.front_end')

@section('content')

    <div class="main">
        <div class="container">
            <!-- BEGIN SIDEBAR & CONTENT -->
            @include('frontend.partial.breadcrumb')
            <div class="row margin-bottom-40">

                <div class="col-md-9 col-sm-12">
                    <div class="content-form-page">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h2>Category</h2>
                                {!! FrontEnd::departments() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @include('frontend.partial.sidebar')
            <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@endsection