<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Macaso">
    <meta name="_token" content="{{ csrf_token() }}" />
	<title>The Business Planners</title>

    <!-- biz planner fav icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-bizplanner.png') }}">

    <!-- google font CDN -->
    <!--link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Serif:400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open%20Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Chelsea%20Market' rel='stylesheet' type='text/css'-->

    <!-- bootstrap css framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/bootstrap.min.css') }}"/>
    <!-- font awesome icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/font-awesome.min.css') }}" />
    <!-- biz planner stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/header.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plan.css') }}" />

    {{ Asset::container('header')->styles() }}
  </head>

  <body style="background-color: #63B6E7;">
    @yield('ecommerce')

    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WHWNCX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WHWNCX');</script>
    <!-- End Google Tag Manager -->

    @include('layout/plan-header')

    <div class="col-xs-12" style="background-color: #ffffff;">
        <div class="wrapper" style="background-color: #ffffff; margin-top: 50px; margin-bottom: 50px;">
             <h2>Sorry, your account has already expired.  Kindly contact us for more details.</h2>
        </div>
    </div>
    @include('layout/footer')
    
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
