<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>KAREN</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('/img/icons/karen-pink.ico') }}">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/bootstrap.js') }}" defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/stripe.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-light bg-link sticky-top">
		<a class="navbar-brand" href="/">
			<img src="{{ asset('/img/icons/karen-pink.ico') }}">
		</a>
		<a class="navbar-brand" href="/">
			<span class="text-brand">KAREN</span>
		</a>

		@if(Session::has('user'))
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContents">
				<i class="fas fa-ellipsis-v"></i>
			</button>
		@endif

		<div class="collapse navbar-collapse" id="navbarContents">
			@if(Session::has("user"))
				<div class="navbar-nav">
					@if(Session("user")->isAdmin == true)
						<div class="svg-wrapper nav-item">
						  	<svg height="40" width="115" xmlns="http://www.w3.org/2000/svg">
								<rect id="shape" height="40" width="115" />
								<div id="text">
									<a href="/admin/users">Users</a>
								</div>
							</svg>
						</div>
						<div class="svg-wrapper nav-item dropdown">
						  	<svg height="40" width="115" xmlns="http://www.w3.org/2000/svg">
								<rect id="shape" height="40" width="115" />
								<div id="text">
									<a>Cars</a>

									<div class="dropdown-menu">
										<a class="nav-link" href="/admin/cars/create">Add new car</a>
										<a class="nav-link" href="/admin/cars">Manage</a>
									</div>
								</div>
							</svg>
						</div>
						<div class="svg-wrapper nav-item">
						  	<svg height="40" width="115" xmlns="http://www.w3.org/2000/svg">
								<rect id="shape" height="40" width="115" />
								<div id="text">
									<a href="/admin/transactions">Transactions</a>
								</div>
							</svg>
						</div>
					@else
						<div class="svg-wrapper nav-item">
						  	<svg height="40" width="115" xmlns="http://www.w3.org/2000/svg">
								<rect id="shape" height="40" width="115" />
								<div id="text">
									<a href="/cars">Cars</a>
								</div>
							</svg>
						</div>
						<div class="svg-wrapper nav-item">
						  	<svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
								<rect id="shape" height="40" width="115"/>
								<div id="text">
									<a href="/transactions">Transactions</a>
								</div>
							</svg>
						</div>
					@endif
				</div>
			@endif

			<div class="navbar-nav flex-row ml-md-auto">
				<div class="nav-item pt-4 pr-5">
					<div id="text">
						<a href="/logout">Logout</a>
					</div>
				</div>
			</div>
		</div>
	</nav>

	<main class="mt-2">
		@yield('content')
	</main>

	<footer>
		<div class="content text-center pt-2 px-4">
			<small class="float-left">@ 2019 KAREN</small>
			<small class="float-right">Designed & developed by Kristanelle Calaguan with
				<i class="fas fa-heart"></i> &
				<i class="fas fa-mug-hot"></i>
			</small>
		</div>
	</footer>
</body>
</html>