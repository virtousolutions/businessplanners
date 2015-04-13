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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plan.css') }}" />

    {{ Asset::container('header')->styles() }}
  </head>

  <body style="background-color: #66bae8;">
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

    <div class="col-xs-12" style="padding: 0; background-color: #ffffff;">
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
    </div>
    <div class="header" style="padding: 10px 0 30px;">
        <header class="clearfix">
            <div class="wrapper clearfix">
                <div class="col-xs-6">
                    @if (isset($business_plan))
                    <h3 style="color: #ffffff;">{{ $business_plan->bp_name }}</h3>
                    <div class="breadcrumbs" style="color: #ffffff; font-size: 13px;">
                        <a href="{{ url('plan') }}" style="color: #ffffff; font-size: 13px;">Plan</a> &#8594; 
                        <span class="current_crumb">{{ $business_plan->bp_name }}</span>
                    </div>
                    @else
                    <h3 style="color: #ffffff; margin-top: 20px;">Start a New Plan</h3>
                    @endif
                </div>
                <div class="support_nav col-xs-6">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"></a>
                          </div>
                          <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Plans <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach ($business_plans as $id => $name)
                                        <li><a href="{{ url('plan/executive-summary/' . $id) }}">{{ $name }}</a></li>
                                    @endforeach
                                    <li class="divider"></li>
                                    <li><a href="{{ url('plan') }}">New Plan</a></li>
                                </ul>
                              </li>
                            </ul>
                          </div><!--/.nav-collapse -->
                        </div><!--/.container-fluid -->
                      </nav>
                </div>
            </div>
        </header>
    </div>
    <div class="col-xs-12" style="padding: 20px 0; background: #FFF url({{ asset('assets/css/plan/shortcodes_files/images/bg-ui-gradient.png') }}) left top repeat-x;">
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
  </body>

</html>
