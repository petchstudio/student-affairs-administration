<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>ระบบการบริหารงานกิจการนักศึกษา - ผู้ดูแลระบบ</title>

		@include('includes.member.link')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/ico"/>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">

				@include('includes.member.navigation')
				@include('includes.member.header')

				<!-- page content -->
				<div class="right_col" role="main">
					@yield('container')
				</div>
				<!-- /page content -->

				@include('includes.member.footer')
			</div>
		</div>
		
		@include('includes.member.script')
		@include('includes.modal')
	</body>
</html>