<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-bizplanner.png') }}">

    <title>The Business Planners</title>
    {{ HTML::style('assets/plugins/bootstrap-3.3.2-dist/css/bootstrap.min.css') }}
    {{ HTML::style('assets/plugins/font-awesome/css/font-awesome.css') }}
  </head>

  <body>
	<div class="row" style="margin-top: 100px;">
		<div class="container">
			<div class="panel panel-default">
				<div class="bs-callout bs-callout-warning">
					<h4><i class="fa fa-warning"></i> Sorry, something went wrong!</h4>
					@yield('content')
				</div>
			</div>
		</div>		
	</div>

	{{ HTML::script('assets/plugins/jquery-1.11.1.min.js') }}
	{{ HTML::script('assets/plugins/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
  </body>

</html>
