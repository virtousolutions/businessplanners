@extends('layout.error')

@section('content')
    <h3>Why you're here?</h3>
	<ul>
		<li>You've typed the wrong URL.</li>
		<li>You've clicked a broken link.</li>
	</ul>

	Click here to return to the <a href=" {{ url('') }} ">main page.</a>
@stop
