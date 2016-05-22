<?php
$scripts = [
	'assets/member/vendors/jquery/dist/jquery.min.js',
	'assets/member/vendors/bootstrap/dist/js/bootstrap.min.js',
	'assets/member/vendors/nprogress/nprogress.js',
	'assets/member/js/moment/moment.min.js',
	'assets/js/plugins/silviomoreto-bootstrap-select/1.7.2-0/dist/js/bootstrap-select.min.js',
];
?>
@foreach ($scripts as $key => $value)
	<script src="{{ asset($value) }}"></script>
@endforeach

@section('script')
	<script src="{{ asset('assets/member/js/custom.js') }}"></script>
@show