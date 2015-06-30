@section('title')
Resources
@stop

@section('content')

<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="wrapper">
	

<form  style="margin: 0 auto; width: 40rem" action="{{ url('resources/download') }}" method="post">
	
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<div class="form-group">
	<label for="email">Email Address</label>
	<input type="email" required class="form-control" name="email" id="email" placeholder="Email">
</div>

<div class="form-group">
	<label for="name">Name</label>
	<input type="text" required class="form-control" name="name" id="name" placeholder="Name">
</div>

<div class="form-group">
	<button class="btn btn-default" type="submit">Submit</button>
</div>

</form>

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>

@stop