<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-36173252-9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-36173252-9');
</script>

    <meta http-equiv="Content-Type">
    
    <title>eLibrary</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta content="e-libarary,DIU,Daffodil International University" name="description">
    <meta content="e-library Daffodil International University ,DIU" name="keywords">
    <meta content="DIU" name="author">
     <link rel="icon" type="image/png" href="{{url('favicon.ico')}}"/>
    <!-- Fonts START -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all"
          rel="stylesheet" type="text/css">
    <!-- Fonts END -->

    <!-- Global styles START -->
    <link href="{{url('member/assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!---link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" --->
    <link href="{{url('member/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link href="{{url('member/assets/pages/css/animate.css')}}" rel="stylesheet">
    <link href="{{url('member/assets/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet">
    <link href="{{url('member/assets/plugins/owl.carousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <!-- Page level plugin styles END -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Theme styles START -->
    <link href="{{url('member/assets/pages/css/components.css')}}" rel="stylesheet">
    <link href="{{url('frontend')}}" rel="stylesheet">
    <link href="{{url('member/assets/corporate/css/style.css')}}" rel="stylesheet">
    <link href="{{url('member/assets/corporate/css/style-responsive.css')}}" rel="stylesheet">
    <link href="{{url('member/assets/corporate/css/themes/green.css')}}" rel="stylesheet" id="style-color">

    <link href="{{url('member/assets/corporate/css/custom.css')}}" rel="stylesheet">

@stack('style')
@stack('styles')
    <!-- Theme styles END -->

</head>
<!-- Head END -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<!-- Body BEGIN -->
<body class="corporate">
<!-- BEGIN TOP BAR -->
<!-- BEGIN STYLE CUSTOMIZER
<div class="color-panel hidden-sm">
  <div class="color-mode-icons icon-color"></div>
  <div class="color-mode-icons icon-color-close"></div>
  <div class="color-mode">
    <p>THEME COLOR</p>
    <ul class="inline">
      <li class="color-red current color-default" data-style="red"></li>
      <li class="color-blue" data-style="blue"></li>
      <li class="color-green" data-style="green"></li>
      <li class="color-orange" data-style="orange"></li>
      <li class="color-gray" data-style="gray"></li>
      <li class="color-turquoise" data-style="turquoise"></li>
    </ul>
  </div>
</div>
<!-- END BEGIN STYLE CUSTOMIZER -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span>+88 9116774 Ex.150-152</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>library@daffodilvarsity.edu.bd</span></li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                    @guest
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                    @else
                        <div class="top-menu">
                            <ul class="nav navbar-nav pull-right top-menu-front">

                                <li class="dropdown dropdown-user">
                                    <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown"
                                       data-hover="dropdown"
                                       data-close-others="true">
                                        @if(Auth::user()->imageIcon==null && Auth::user()->imageBase64)
                                        <img alt="" width="20px" class="img-circle"
                                             src="data:image/png;base64,{{ Auth::user()->imageBase64 }}"/>
                                        @elseif(Auth::user()->imageIcon)
                                            <img alt="" width="20px" class="img-circle"
                                                 src="{{url('uploads/profile/icon',Auth::user()->imageIcon)}}"/>
                                        @endif
                                            <span class="username username-hide-on-mobile"> {!! Auth::user()->displayName !!} </span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        <li>
                                            <a href="{{url('/admin')}}">
                                                <i class="fa fa-dashboard"></i> My Dashboard </a>
                                        </li>
                                        <li>
                                            <a href="{{url('profile')}}">
                                                <i class="fa fa-user"></i> My Profile </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-leaf"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!-- END USER LOGIN DROPDOWN -->
                                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                <li class="dropdown dropdown-quick-sidebar-toggler">
                                    <a href="javascript:" class="dropdown-toggle">
                                        <i class="icon-logout"></i>
                                    </a>
                                </li>
                                <!-- END QUICK SIDEBAR TOGGLER -->
                            </ul>


                        </div>
                            @endguest
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>
<!-- END TOP BAR -->
<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        <a class="site-logo" href="{{url('/')}}"><img src="{{url('member/assets/image/logo.png')}}" width="230px"
                                                      alt="Metronic FrontEnd"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
            <ul>
                <li class="active">
                    <a href="{{url('/')}}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{url('/about-us')}}">About Us</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('services')}}">
                        Services
                    </a>

                    <ul class="dropdown-menu">
                        {!! FrontEnd::serviceMenu() !!}
                    </ul>
                </li>
                <li>
                    <a href="http://dspace.daffodilvarsity.edu.bd:8080/" target="_blank">Institutional
                        Repository</a>
                </li>
                <li>
                    <a href="{{url('/feedback')}}">Feedback</a>
                </li>
                <li><a href="{{url('/contact-us')}}">Contact Us</a></li>


                <!-- BEGIN TOP SEARCH -->
                <!--      <li class="menu-search">
                          <span class="sep"></span>
                          <i class="fa fa-search search-btn"></i>
                          <div class="search-box">
                              <form action="index-header-fix.html#">
                                  <div class="input-group">
                                      <input type="text" placeholder="Search" class="form-control">
                                      <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Search</button>
                          </span>
                                  </div>
                              </form>
                          </div>
                      </li>
      -->

                <!-- END TOP SEARCH -->
            </ul>
        </div>
        <!-- END NAVIGATION -->
    </div>
</div>

@yield('content')

<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2>About us</h2>
                <p>This eLibrary offers over 28,000 eBooks. Download or read through online. You will find the world's
                    great resources here. You also get a million <a href="{{url('/about-us')}}">more..</a></p>


                @include('frontend.partial.recent_visitor')

            </div>
            <!-- END BOTTOM ABOUT BLOCK -->



            <!-- BEGIN TWITTER BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2 class="margin-bottom-20">Important Links</h2>
                <ul class="list-unstyled margin-bottom-20">
                    <li><i class="fa fa-check"></i> <a target="_blank" href="https://daffodilvarsity.edu.bd/"> DIU
                            Home</a></li>
                    <li><i class="fa fa-check"></i> <a target="_blank" href="http://library.daffodilvarsity.edu.bd/">
                            Library Home</a></li>
                    <li>
                    <li><i class="fa fa-check"></i> <a target="_blank" href="https://youtu.be/uV4afWz6W2s"> Library
                            Documentary</a></li>
                    <li>
                        <i class="fa fa-check"></i> <a href="{{url('/privacy-policy')}}">Privacy policy </a>
                    </li>
                    <li>
                        <i class="fa fa-check"></i> <a href="{{url('/terms-of-use')}}">Terms of Use</a>
                    </li>


                </ul>
            </div>
            <!-- END TWITTER BLOCK -->

            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2>Our Contacts</h2>
                <address class="margin-bottom-40">

                    Daffodil International University Library<br>
                    100/A, Shukrabad, Mirpur Road, Dhaka<br>
                    E-mail:
                    <a href="mailto:library@daffodilvarsity.edu.bd" target="_top">library@daffodilvarsity.edu.bd</a><br>
                    Phone: +88 48111639, 48111670, 9128705, 9132634 <br> (Ex. 123,149,150,151,152)<br>
                    Fax: 88-02-9131947<br>

                </address>
            </div>
            <!-- END BOTTOM CONTACTS -->
        </div>
    </div>
</div>
<!-- END PRE-FOOTER -->

<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="container">
        <div class="row">

            <!-- BEGIN PAYMENTS -->
            <div class="col-md-3 col-sm-3">
                <ul class="social-footer list-unstyled list-inline pull-right">
                    <li><a target="_blank" href="https://www.facebook.com/DIULIBRARY/"><i
                                    class="fa fa-facebook"></i></a></li>
                    <li><a href="javascript:"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="javascript:"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="javascript:"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="javascript:"><i class="fa fa-skype"></i></a></li>
                    <li><a href="javascript:"><i class="fa fa-github"></i></a></li>
                    <li><a href="javascript:"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
            <!-- END PAYMENTS -->
            <!-- BEGIN COPYRIGHT -->
            <div class="col-md-6 col-sm-6 padding-top-10">

                Copyright © {{date('Y')}} Daffodil International University Library. All rights reserved.
                </a>
            </div>
            <!-- END COPYRIGHT -->
            <!-- BEGIN POWERED -->
            <!--<div class="col-md-3 col-sm-3 text-right">
                <p class="powered">Powered by: <a href="https://daffodilvarsity.edu.bd/">DIU</a></p>
            </div>-->
            <!-- END POWERED -->
        </div>
    </div>
</div>
<!-- END FOOTER -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
<!--[if lt IE 9]>
<script src="{{url('frontend')}}"></script>
<![endif]-->
<script src="{{url('member/assets/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('member/assets/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{url('member/assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('member/assets/corporate/scripts/back-to-top.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="{{url('member/assets/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>

@stack('script_page')

<!-- pop up -->
<script src="{{url('member/assets/plugins/owl.carousel/owl.carousel.min.js')}}" type="text/javascript"></script>
<!-- slider for products -->

<script src="{{url('member/assets/corporate/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{url('member/assets/pages/scripts/bs-carousel.js')}}" type="text/javascript"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script type="text/javascript">
    jQuery(document).ready(function () {
        Layout.init();
        Layout.initOWL();
        //Layout.initTwitter();
        //Layout.initFixHeaderWithPreHeader();
        /* Switch On Header Fixing (only if you have pre-header) */
        Layout.initNavScrolling();
    });


    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 7,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
    });

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });

    /*  //select place holder
     $('.selectpicker').selectpicker(
          {
              liveSearchPlaceholder: 'Placeholder text'
          }
      );*/
</script>

@stack('script')
@stack('scripts')
<!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>