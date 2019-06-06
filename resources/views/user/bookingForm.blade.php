@extends('layouts.app')

@section('content')

<div class="container">
	@if(Session::has("message"))
		<div class="alert alert-light alert-trans col-sm-12 col-lg-5">
			<span class="text-success">{{Session('message')}}</span>
		</div>
	@endif

	@if(Session::has("error"))
	<div class="alert alert-light alert-trans col-sm-12 col-lg-5">
		<span class="text-danger mb-1">{{ Session("error") }}</span><br>
	</div>
	@endif

	{{-- @dd(Session()) --}}
	<div class="col-sm-12 col-lg-5">
		<div class="card">
			<div class="card-header bg-transparent border-0">
				<div class="col-sm-12 w-50 container-fluid">
					<img src="{{Session::get('booking')['carImage']}}" class="img-fluid border-0">
				</div>
			</div>
			<div class="card-body bg-transparent border-0">
				<ul style="list-style: none">
					<li>Brand and Model: {{Session::get('booking')['carName']}}</li>
					<li>Start Date: {{\Carbon\Carbon::parse(Session::get('booking')['startDate'])->toDayDateTimeString()}}</li>
					<li>End Date: {{\Carbon\Carbon::parse(Session::get('booking')['endDate'])->toDayDateTimeString()}}</li>
					<li>Rented day(s): {{Session::get('booking')['bookedDays']}}</li>
					@if(Session::get('booking')['excessHours'] > 12)
						<li>Extra hours: {{Session::get('booking')['excessHours']}}</li>
						<li>+More 12 hour-charge fee: Php {{number_format(Session::get('booking')['carPrice'], 2)}}</li>
					@elseif(Session::get('booking')['excessHours'] < 12 && Session::get('booking')['excessHours'] > 0)
						<li>Extra hours: {{Session::get('booking')['excessHours']}}</li>
						<li>+Prorated charge: Php {{number_format(Session::get('booking')['excessHoursPrice'], 2)}}</li>
					@endif
					<li class="pt-3">Total Amount: <strong>Php {{number_format(Session::get('booking')['totalCharge'], 2)}}</strong></li>
				</ul>
			</div>

			<div class="card-footer bg-transparent border-0 pb-3">
				<script src="https://js.stripe.com/v3/"></script>
				<form method="POST" action="/charge/stripe" class="float-right">
					@csrf
					<script
						src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-key="{{config('constants.stripePubKey')}}"
						data-amount="{{(Session::get('booking')['totalCharge'])*100}}"
						data-name="KAREN"
						data-description="{{(Session::get('booking')['carName'])}} - {{Session::get('booking')['bookedDays']}} day(s)"
						data-image="{{ asset('/img/icons/karen-pink.png') }}"
						data-locale="auto"
						data-currency="php">
					</script>

					<script>
						document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
					</script>

					<button type="submit" class="btn btn-danger">Pay with <strong>Stripe</strong></button>
				</form>
				<a href="/cars" class="btn btn-secondary float-left">Cancel</a>
			</div>
		</div>
	</div>
</div>

@endsection