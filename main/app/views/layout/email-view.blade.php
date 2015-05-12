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
  </head>

  <body style="background-color: #66bae8;">
    <div class="wrapper">
        @yield('content')
    </div>	
  </body>

</html>
