<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
	<meta name="description" content="@yield('keyword')">
	<title>@yield('title')</title>
	
    <!-- biz planner fav icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-bizplanner.png') }}">

	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/bootstrap.min.css') }}"/>
    <!-- font awesome icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/font-awesome.min.css') }}" />
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('css/screen.css') }}">

	<meta name="_token" content="{{ csrf_token() }}" />
	<meta name="description" content="We create professionally written business plan that will help you to succeed, we'll find out everything we need to know about a business in order to create a professional business plan">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    {{ Asset::container('header')->styles() }}


</head>
<body>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WHWNCX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WHWNCX');</script>
@yield('tagmanager')
    <!-- End Google Tag Manager -->

    <div id="head-bg">
        <div class="container">
            <nav class="navbar navbar-default">
              <div class="container-fluid" style="padding: 0px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header col-md-2">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ url('') }}">
                        <img src="{{ url('assets/img/logo.png') }}">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="col-md-8">
                    <div class="collapse navbar-collapse" id="main-menu-collapse">
                      <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}" id="forhome">Home</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Packages <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="{{ url('diy-business-plan-package') }}">DIY package</a></li>
                            <li><a href="{{ url('value-business-plan-package') }}">Value package</a></li>
                            <li><a href="{{ url('standard-business-plan-package') }}">Standard Package</a></li>
                            <li><a href="{{ url('professional-business-plan-package') }}">Professional Package</a></li>
                            <li><a href="{{ url('premium-business-plan-package') }}">Premium Package</a></li>
                          </ul>
                        </li>
                        <li><a href="{{ url('/#info-home') }}" id="forfeature">Features</a></li>
                        
                        <li><a href="{{ url('/#contactus') }}" id="forcontactus">Contact Us</a></li>
                        <li><a href="{{ url('resources') }}" id="forfeature">Resources</a></li>
                        <li><a href="{{ url('blog') }}" id="forfeature">Blog</a></li>
                        @if (Auth::check())
                            <li><a href="{{ url('plan') }}">My Plan</a></li>
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                        @else
                            <li><a href="{{ url('login') }}">Login</a></li>
                        @endif
                       
                       
                      </ul>
                    </div>
                </div>
                <div id="info-head" class="col-md-2">
                    0345 052 2742
                </div>
              </div><!-- /.container-fluid -->
            </nav>
        </div>
    </div>
	@yield('content')

    <a href="#" id="scrollcon" class="scrolltop">Top</a>
	@include('layout/footer')
	<!-- Scripts -->
    <!--
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    -->
    {{ HTML::script('assets/plugins/jquery-1.11.1.min.js') }}
    {{ HTML::script('assets/plugins/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
	<script src="{{asset('js/jquery.validate.js')}}"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>

	<script>
    var url = {
        "current_url": "{{Request::url()}}",
    };
    </script>
    
	<script src="{{ asset('js/global.js') }}"></script>

	@yield('js')
	
	{{ Asset::container('footer')->scripts() }}
	
	 <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="//v2.zopim.com/?2tZPSGz9BA795pN02UdFe48eTxSWijXu";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->
</body>
</html>
