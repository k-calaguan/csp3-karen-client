<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>KAREN</title>
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

<div style="background-image: url({{url('/img/registration-bg.jpg')}}); background-size: cover; height: 100%">
	<a href="/"><img class="pl-3 pt-3 pb-5" src="{{ asset('/karen-pink.ico') }}"></a>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-5 card" style="background-color: rgba(252, 252, 252, 0.7); border: none">
				<div class="mt-3">
					<h3 class="pl-3 text-black-50">Register now to discover cars perfect for any trip.</h3>
				</div>
				<div class="card-body">
					<form method="POST" action="/register">
						@csrf
						<div class="form-group">
							<div>
								<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Full Name">
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-12 col-lg-6">
									<input id="dob" type="text" class="form-control" name="dob" min="1800" value="{{ old('dob') }}" required placeholder="Birth Date" onfocus="(this.type = 'date')">
								</div>
								
								<div class="col-sm-12 col-lg-6">
									<select id="gender" class="form-control" name="gender" required>
										<option class="text-secondary" value="{{ old('gender') }}">Select your gender</option>
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="dwts">Don't want to say</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div>
								<input id="contactNum" type="tel" pattern="[0-9]{11}" placeholder="Mobile Number" class="form-control" name="contactNum" value="{{ old('contactNum') }}" required onfocus="(this.placeholder = 'ex. 09123456789')">
							</div>
						</div>

						<div class="form-group">
							<div>
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email')}}" required placeholder="Email Address">
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-12 col-lg-6">
									<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}"required placeholder="Password">
								</div>
								<div class="col-sm-12 col-lg-6">
									<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('parssword_confirmation')}}" required placeholder="Confirm password">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div>
								<input id="homeAddress" type="text" class="form-control" name="homeAddress" value="{{ old('homeAddress')}}" required placeholder="Home Address">
							</div>
						</div>

						<div class="form-group mb-0">
							<div>
								<button type="submit" class="btn btn-danger float-right">{{ __('Register') }}</button>
							</div>
						</div>
					</form>
					
					<p>
						<h7>Already have a KAREN account?</h7>
						<a href="/login" class="btn-link">{{ __('Login here') }}</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>