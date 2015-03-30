<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>The Business Planners</title>

<!-- biz planner fav icon -->
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-bizplanner.png') }}">

<!-- google font CDN -->
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Serif:400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open%20Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Chelsea%20Market' rel='stylesheet' type='text/css'>

<!-- bootstrap css framework -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/bootstrap.min.css') }}"/>
<!-- font awesome icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/font-awesome.min.css') }}" />
<!-- biz planner stylesheet -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/header.css') }}" />

    {{ Asset::container('header')->styles() }}
  </head>

  <body>
    <div class="container" style="padding-top: 10px;">
        <div class="wrapper">
            <div class="col-xs-12 col-sm-7" style="padding: 0px; margin: 20px 0; text-align: left;">
                <a href="{{ url('') }}">
                    <img style="width: 250px; margin-left: 0px;" src="{{ url('assets/img/logo.png') }}"/>
                </a>
            </div>
            <!--div class="col-xs-12 col-sm-5 text-right">
                <img src="{{ asset('assets/img/secureseal.png') }}" style="width: 200px" alt="" class="seal">
                <p>Questions? Call - 01732 2042 4188</p>
            </div-->
        </div>
    </div>
    <div class="header">
        @include('layout.header')
    </div>
	<div class="wrapper">
        <div class="wrapper">
            @yield('content')
		</div>	
    </div>
    <div class="footer">
    @include('layout/footer')
    </div>
	
	{{ HTML::script('assets/plugins/jquery-1.11.1.min.js') }}
	{{ HTML::script('assets/plugins/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
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

    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W34H63"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W34H63');</script>
    <!-- End Google Tag Manager -->
  </body>

</html>
