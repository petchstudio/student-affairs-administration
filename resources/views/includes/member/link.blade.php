<?php
$links = [
	'assets/js/plugins/silviomoreto-bootstrap-select/1.7.2-0/dist/css/bootstrap-select.min.css',
	'assets/member/vendors/bootstrap/dist/css/bootstrap.min.css',
	'assets/member/vendors/font-awesome/css/font-awesome.min.css',
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
	<link href="{{ asset('assets/member/css/custom.css') }}" rel="stylesheet">
@show