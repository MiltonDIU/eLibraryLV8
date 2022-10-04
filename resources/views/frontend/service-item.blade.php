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
                                @foreach($serviceItem as $item)
                                    {!! FrontEnd::getItem($item) !!}
                                    <hr class="blog-post-sep">




                                @endforeach

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