@extends('layouts.front_end')

@section('content')

    <div class="main">
        <div class="container">
        @include('frontend.partial.breadcrumb')
        <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <div class="content-page">

                        <div class="row">
                            <!-- BEGIN LEFT SIDEBAR -->
                            <div class="col-md-9 col-sm-9 blog-posts">
                            {!! FrontEnd::getItemDetails($item,$years) !!}
                            </div>
                            <!-- END LEFT SIDEBAR -->
                            @include('frontend.partial.sidebar')
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@endsection
@include('notification.notify')

@push('style')
    <style>
        .btn-cool-blues {
            background: #2193b0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #6dd5ed, #2193b0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #6dd5ed, #2193b0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: #fff!important;
            border: 3px solid #eee;
            line-height: 35px;
        }

        .btn-dark-blue {
            background: #7474BF;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #348AC7, #7474BF);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: #fff!important;
            border: 3px solid #eee;
            text-decoration: none;
            line-height: 35px;
        }
        .btn-dark-blue:focus {
            background-color:#2193b0;
        }

        .btn-cool-blues:focus {
            background-color:#4086C5;
        }
        .download:hover{text-decoration: none}
    </style>
@endpush