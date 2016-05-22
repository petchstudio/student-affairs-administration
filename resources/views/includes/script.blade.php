<?php
$scripts = [
	'assets/js/jquery-1.11.3.min.js',
	'assets/js/bootstrap.min.js',
	'assets/js/jasny-bootstrap.min.js',
];
?>
@foreach ($scripts as $key => $value)
	<script src="{{ asset($value) }}"></script>
@endforeach

@section('script')
	<script src="{{ asset('assets/js/init.js') }}"></script>
@show