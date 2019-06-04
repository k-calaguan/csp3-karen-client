<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Karen</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('/img/icons/karen-pink.ico') }}">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/bootstrap.js') }}" defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">

	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body style="height: 100%">

<div class="login-background">
	<a id="text-none" href="/">
		<img class="pl-3 pt-3 pb-5" src="{{ asset('/img/icons/karen-pink.ico') }}">
		<span class="text-brand">KAREN</span>
	</a>
	<div class="container justify-contents-center">

		@if(Session::has("message"))
			<div class="alert col-sm-12 col-lg-4">
				<span class="text-light">{{Session('message')}}</span>
			</div>
		@endif

		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-5 card login-card">
					<div class="mt-3">
						<h3 class="pl-3 text-black-50">Ready for another road trip?</h3>
					</div>
					<div class="card-body">
						<form method="POST" action="/login">
							@csrf
							<div class="form-group">
								<label for="email" class="text-secondary">Email Address</label>
								<div class="form-group">
									<input id="email" type="text" name="email" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="text-secondary">Password</label>
								<div class="form-group">
									<input id="password" type="password" name="password" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-danger float-right">Login</button>
							</div>
						</form>

						<p>
							<h7>Don't have an account?</h7>
							<a href="/register" class="btn-link text-primary">Sign up</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>