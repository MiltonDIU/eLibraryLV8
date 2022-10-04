@extends('layouts.front_end')
@section('content')
    <div class="main">
        <div class="container">
            @include('frontend.partial.breadcrumb')
            
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-12">

                    <div class="content-form-page">
                        <div class="row margin-bottom-40" style="margin: 0 auto">

                            @for($i=65;$i<=90;$i++)
                                <div class="azLetter" style="width: 25px; float: left; ">
                                    <a data-type="{{chr($i)}}" style="padding: 10px" href="{{url('a2z/'.chr($i))}}"
                                       class="a_z">{{chr($i)}}</a>
                                </div>
                            @endfor
                        </div>
                        <div class="row">

                            <section class="articles">
                                @include('frontend.a2zGetItem')
                            </section>

                        </div>
                    </div>
                </div>
                @include('frontend.partial.sidebar')



            </div>
            <!-- END CONTENT -->
        </div>
    </div>
    </div>
@endsection
@push('style')

@endpush
@push('script')
    <script type="text/javascript">

        $('body').on('click', '.azLetter a', function (e) {
            e.preventDefault();
            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="http://s3.amazonaws.com/libapps/apps/common/images/ajax-loader.gif" />');
            var url = $(this).attr('href');


            var q = $(this).attr('data-type');
            getAZ(q);
            window.history.pushState("", "", url);
        });

        function getAZ(q) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': Laravel.csrfToken
                },
                type: "POST",
                url: '{{ url('/a2z') }}',
                data: {'q': q},
                cache: false,
                success: function (response) {
                    //console.log(q);
                    // $("#message").show(3000).html("ok ths is success").addClass('success').hide(5000);
                    $('.articles').html(response);
                }
            });
        }

        $(function () {
            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                $('#load a').css('color', '#dfecf6');
                $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="http://s3.amazonaws.com/libapps/apps/common/images/ajax-loader.gif" />');
                var url = $(this).attr('href');
                getArticles(url);
                window.history.pushState("", "", url);
            });


            function getArticles(url) {
                $.ajax({
                    url: url
                }).done(function (data) {
                    $('.articles').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });
            }
        });
    </script>
@endpush