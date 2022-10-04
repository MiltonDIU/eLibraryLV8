<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-36173252-9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-36173252-9');
</script>

    <meta charset="utf-8"/>
    <title>e-library</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #1 for " name="description"/>
    <meta content="" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="{{url('assets/admin/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/admin/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/admin/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('assets/admin/global/css/components.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('assets/admin/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>


    @stack('styles')
    <link href="{{url('assets/admin/pages/css/login.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/admin/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png" href="{{url('favicon.ico')}}"/>
</head>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
</head>
<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{url('/')}}">
        <img src="{{url('assets/image/library_logo.png')}}" alt="Logo"/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    {{ csrf_field() }}
    @yield('content')


</div>
<div class="copyright"> {{date('Y')}} © e-library,DIU.</div>
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>


<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="{{ url('assets/admin/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/admin/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/admin/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ url('assets/admin/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('assets/admin/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/admin/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{url('assets/admin/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ url('assets/admin/global/scripts/app.min.js') }}" type="text/javascript"></script>

@stack('scripts')

<script src="{{ url('assets/admin/pages/scripts/login.js') }}" type="text/javascript"></script>


<script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
</script>

</body>

</html>