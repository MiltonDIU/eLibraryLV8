@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(Session::has('create'))
                        <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    @endif


                    <div class="portlet light bordered">
                        <div class="portlet-title" style="margin-bottom: 0px">
                            <div class="caption">
                                <i class="icon-equalizer font-red-sunglo"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Search by </span>
                                <span class="caption-helper">Name, Email, Department, DIU ID, Mobile, Designation, Concern Name, Concern Domain etc.</span>
                            </div>
                            <div class="actions" style="padding: 0px">
                                <div class="panel panel-default" style="margin-bottom: 0px; border: 0px">
                                    {!! Form::open(['url' => '#', 'class' => 'form-horizontal', 'files' => true]) !!}
                                    <div class="input-group">
                                        {!! Form::text('q', null, ['class' => 'form-control', 'id'=>'searchText', 'required' => 'required']) !!}
                                        {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                                        {!! Form::hidden('edit',Session::get('viewIndex.edit')=="edit"?true:false,['id'=>'edit']) !!}
                                        {!! Form::hidden('show',Session::get('viewIndex.show')=="show"?true:false,['id'=>'show']) !!}
                                        {!! Form::hidden('destroy',Session::get('viewIndex.destroy')=="destroy"?true:false,['id'=>'destroy']) !!}
                                        {!! Form::hidden('slug',Session::get('controller.slug')?Session::get('controller.slug'):false,['id'=>'slug']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    @if (count($users) > 0)
                        <div class="table-responsive">
                            @include('admin.users.getUser')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')

@endpush
@push('scripts')

    <script type="text/javascript">
        $(function () {
            $("#searchText").keyup(function () {
                var q = $("#searchText").val();
                var edit = $("#edit").val();
                var show = $("#show").val();
                var destroy = $("#destroy").val();
                var slug = $("#slug").val();
                // alert("test");
                // console.log(q);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': Laravel.csrfToken
                    },
                    type: "POST",
                    url: '{{ url('/users') }}',
                    data: {'q': q,'edit': edit,'destroy': destroy,'show': show,'slug':slug},
                    cache: false,
                    success: function (response) {
                         $("#message").show(3000).html("ok ths is success").addClass('success').hide(5000);
                        $('.table-responsive').html(response);
                    }
                });
            });

            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                $('#load a').css('color', '#dfecf6');
                //$('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="http://blog.teamtreehouse.com/wp-content/uploads/2015/05/InternetSlowdown_Day.gif" />');
                var url = $(this).attr('href');
                getArticles(url);
                window.history.pushState("", "", url);
            });

            function getArticles(url) {
                var edit = $("#edit").val();
                var show = $("#show").val();
                var destroy = $("#destroy").val();
                var slug = $("#slug").val();
                $.ajax({
                    url: url,
                    data: {'edit': edit,'destroy': destroy,'show': show,'slug':slug},
                }).done(function (data) {
                    $('.table-responsive').html(data);
                }).fail(function () {
                    alert('User could not be loaded.');
                });
            }
        });
    </script>
@endpush

@include('notification.notify')