
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="description" content="We create professionally written business plan that will help you to succeed, we'll find out everything we need to know about a business in order to create a professional business plan">
    <title>The Business Planners - Professional Business Plans</title> 
	

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
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/header.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />

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

<!-- HEADER -->
@include('layout.header')


@yield('content');

<!-- FOOTER -->
@include('layout.footer')

<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

{{ HTML::script('assets/plugins/jquery-1.11.1.min.js') }}
{{ HTML::script('assets/plugins/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
{{ Asset::container('footer')->scripts() }}

<script type="text/javascript">
var __lc = {};
__lc.license = 6379881;

(function() {
 var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
 lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>

</body>
</html>