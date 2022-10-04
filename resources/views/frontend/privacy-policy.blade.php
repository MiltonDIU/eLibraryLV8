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
                            <div class="col-md-9 col-sm-9 blog-posts">
                                <p>
                                    If you read this eLibrary web site, no more information is collected than is
                                    typically collected in server logs by web sites in general.
                                </p>
                                <p>
                                    Specifically, all usage of <a
                                            href="#">#</a> is intended to be
                                    anonymous. Your name, or any other identifying information, is never requested.
                                    However, your IP address and requests from that address are saved by our servers,
                                    for periodic analysis of Web site traffic, quality assurance, and aggregate
                                    reporting.
                                </p>

                            </div>
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