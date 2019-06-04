<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>KAREN</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('/img/icons/karen-pink.ico') }}">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/bootstrap.js') }}" defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	
	<!-- Styles -->
	<link href="{{ asset('css/landingpage.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
	<div class="flex-center full-height">
		<div class="content">
			<h2 class="text-extra">Trouble getting a car for a road trip?</h2>
			<h1><img class="logo-icon" src="{{ asset('/img/icons/karen-pink.ico') }}"><span class="text-brand">KAREN</span></h1>
			<h4 class="text-extra">will make it nice and easy!</h4>
			<a class="btn btn-danger mt-3" id="btn-effect" href="/register">Learn more</a>
		</div>
	</div>
</body>
</html>
