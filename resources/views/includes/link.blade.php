<?php
$links = [
	'assets/css/jasny-bootstrap.min.css',
	//'assets/fonts/material-design-iconic-font/material-design-iconic-font.min.css',
	'assets/fonts/prompt/prompt-light.css',
	'assets/fonts/prompt/prompt-extralight.css',
	'assets/fonts/prompt/prompt-regular.css',
	'assets/fonts/ionicons/ionicons.css',
];
?>
@section('link')
	@foreach ($links as $key => $value)
		<link href="{{ asset($value) }}" rel="stylesheet">
	@endforeach
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
@show