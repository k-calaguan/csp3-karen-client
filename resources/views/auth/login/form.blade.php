<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Karen</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('/karen-pink.ico') }}">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/bootstrap.js') }}" defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro:500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body style="height: 100%">

<div style="background-image: url({{url('/img/login-bg.jpg')}}); background-size: cover; height: 100%">
	<a href="/"><img class="pl-3 pt-3 pb-5" src="{{ asset('/karen-pink.ico') }}"></a>
	<div class="container justify-contents-center">

		@if(Session::has("message"))
			<div class="alert col-sm-12 col-lg-4">
				<span class="text-light">{{Session('message')}}</span>
			</div>
		@endif

		<div class="content">
			<div class="row">
				<div class="col-sm-12 col-lg-5 card" style="background-color: rgba(252, 252, 252, 0.7); border: none">
					<div class="mt-3">
						<h3 class="pl-3 text-black-50">Ready for another road trip?</h3>
					</div>
					<div class="card-body">
						<form method="POST" action="/login">
							@csrf
							<div class="form-group">
								<label for="email" class="text-secondary">{{ __('Email Address')}}</label>
								<div class="form-group">
									<input id="email" type="text" name="email" class="form-control" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="text-secondary">{{ __('Password')}}</label>
								<div class="form-group">
									<input id="password" type="password" name="password" class="form-control" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-danger float-right">Login</button>
							</div>
						</form>

						<p>
							<h7>Don't have an account?</h7>
							<a href="/register" class="btn-link text-primary">{{ __('Sign up') }}</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>