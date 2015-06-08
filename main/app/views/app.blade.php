<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
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
<!-- End Google Tag Manager -->

	<div id="head-bg">
		<div class="container">
			<div id="logo" class="col-md-2">
			<a href="{{ url('') }}">
				<img src="{{ url('assets/img/logo.png') }}">
			</a>
			</div><!-- #logo -->
			<div id="top-menu" class="col-md-8">
                @if (!isset($hide_main_navigation))
                <div class="col-md-10 col-md-offset-1">
                    <div id="btn-resp"></div>
                    <ul>
                        <li><a href="{{ url('/') }}" id="forhome">Home</a></li>
                        <li><a href="{{ url('/#info-home') }}" id="forfeature">Features</a></li>
                        <!-- <li><a href="{{url('blog')}}">Blog</a></li> -->
                        <li><a href="{{ url('/#contactus') }}" id="forcontactus">Contact Us</a></li>
                        @if (Auth::check())
                            <li><a href="{{ url('plan') }}">My Plan</a></li>
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                        @else
                            <li><a href="{{ url('login') }}">Login</a></li>
                        @endif
                    </ul>
                </div>
                @endif
			</div><!-- #top-menu -->
			<div id="info-head" class="col-md-2">0345 052 2742</div>
		</div><!-- .body_container -->
	</div>

	@yield('content')

    <a href="#" id="scrollcon" class="scrolltop">Top</a>
	<footer>
		<div class="container">
			<div id="footer-menu" class="col-md-7">
				<ul>
					<li><a href="javascript:void(0)" id="forcontactus">Contact</a></li>
					<li><a href="{{url('privacy')}}">Privacy Policy</a></li>
					<li><a href="{{url('license')}}">Cookie Policy</a></li>
				</ul>
			</div><!-- #footer-menu -->
			
			<p style="padding-left: 6px;" class="col-md-12">Rates are variable dependant on circumstances and will be discussed in full once an assessment has been made.</p>
			

			<p style="padding-left: 6px;" class="col-md-12">© 2015 The Business Planners. All Rights Reserved. </p>
			
				<div id="social-icons" class="col-xs-12">
				<ul>
					<li><a href="https://www.facebook.com/thebusinessplannersuk?ref=bookmarks"><img src="{{url('assets/img/footer-social-fb.png')}}"></a></li>
					<li><a href="https://twitter.com/BizPlannersUK"><img src="{{url('assets/img/footer-social-twitter.png')}}"></a></li>
				</ul>
			</div><!-- #social-icons -->

		</div><!-- .container -->
	</footer>

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
