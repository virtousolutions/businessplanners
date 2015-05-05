<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Business Planners</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
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
			<div id="logo" class="col-md-3">
				<img src="{{ url('assets/img/logo.png') }}">
			</div><!-- #logo -->
			<div id="top-menu" class="col-md-6">
				<div id="btn-resp"></div>
				<ul>
					<li><a href="#" id="forhome">Home</a></li>
					<li><a href="#" id="forfeature">Features</a></li>
					<li><a href="{{url('blog')}}">Blog</a></li>
					<li><a href="#" id="forcontactus">Contact Us</a></li>
				</ul>
			</div><!-- #top-menu -->
			<div id="info-head" class="col-md-3">0345 052 2742</div>
		</div><!-- .body_container -->
	</div>

	@yield('content')

<a href="#" id="scrollcon" class="scrolltop">Top</a>
	<footer>
		<div class="container">
			<div id="footer-menu" class="col-md-7">
				<ul>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Cookie Policy</a></li>
				</ul>
			</div><!-- #footer-menu -->
			
			<p class="col-md-9">Rates are variable dependant on circumstances and will be discussed in full once an assessment has been made.</p>
			<div id="social-icons" class="col-xs-12">
				<ul>
					<li><a href="#"><img src="{{url('assets/img/footer-social-fb.png')}}"></a></li>
					<li><a href="#"><img src="{{url('assets/img/footer-social-twitter.png')}}"></a></li>
					<li><a href="#"><img src="{{url('assets/img/footer-social-linked.png')}}"></a></li>
					<li><a href="#"><img src="{{url('assets/img/footer-social-google.png')}}"></a></li>
				</ul>
			</div><!-- #social-icons -->
			<p class="col-md-12">© 2015 Contractors Pro. All Rights Reserved. Company Number: 0871 789 0580. Address: Constractors Pro Offices in London in Tower 42.</p>
			
			
		</div><!-- .container -->
	</footer>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
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
