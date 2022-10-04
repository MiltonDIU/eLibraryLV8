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
                                <div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div>
                            </div>
                            <div class="col-md-3 col-sm-3 blog-posts">
                                <p>
                                    International University Library<br>
                                    100/A, Shukrabad, Mirpur Road, Dhaka<br>
                                    E-mail:
                                    <a href="mailto:library@daffodilvarsity.edu.bd" target="_top">library@daffodilvarsity.edu.bd</a>
                                    Phone: +88 48111639, 48111670, 9128705, 9132634 (Ex. 123,149,150,151,152)<br>
                                    Fax: 88-02-9131947<br>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@endsection
@push('script_page')
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="{{url('member/assets/plugins/gmaps/gmaps.js')}}" type="text/javascript"></script>
    <script src="{{url('member/assets/pages/scripts/contact-us.js')}}" type="text/javascript"></script>
@endpush

@push('script')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            ContactUs.init();
        });
    </script>
@endpush
