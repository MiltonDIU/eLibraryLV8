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
                                    Our eBooks may be freely used only for our users because most are protected by
                                    copyright law. They may not be free or copyright for other individuals,
                                    organizations, institutions, commercial use or other countries. Readers outside of
                                    the Bangladesh must check the copyright terms of their countries before downloading,
                                    reading or redistributing our eBooks.
                                </p>
                                <p>
                                    <strong>This eLibrary website is for human users only.</strong> Any real or
                                    perceived use of automated tools to access our site will result in a block of your
                                    IP address. This site utilizes cookies, captchas and related technologies to help
                                    assure the site is aximally available for human users only.
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