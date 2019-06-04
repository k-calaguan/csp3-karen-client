@extends('layouts.app')

@section('content')

<div class="container">
	<div class="card col-sm-12 col-lg-5">
		<img src="{{Session('carImage')}}" class="img-thumbnail" style="width: auto; border: none; margin: 0 20px 0 20px">	

		<div class="card-body">
			<ul style="list-style: none">
				<li>Car: {{Session('carName')}}</li>
				<li>No. of days: {{Session('bookedDays')}}</li>
				<li>Start Date: {{\Carbon\Carbon::parse(Session('starspanate'))->format('m-d-Y')}}</li>
				<li>End Date: {{\Carbon\Carbon::parse(Session('endDate'))->format('m-d-Y')}}</li>
				<li>Total Amount: Php{{Session('totalCharge')}}.00</li>
			</ul>

			<script src="https://js.stripe.com/v3/"></script>
			<form method="POST" action="/charge" class="float-right">
				@csrf
				<script
					src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="{{ env('STRIPE_PUB_KEY')}}"
					data-amount="{{Session('totalCharge')*100}}"
					data-name="Karen"
					data-description="Test charge for car rental fees"
					data-image="{{ asset('/karen-pink.png') }}"
					data-locale="auto"
					data-currency="php">
				</script>

				<script>
					document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
				</script>
				<button type="submit" class="btn btn-danger">Pay with <strong>Stripe</strong></button>
			</form>
		</div>
	</div>
</div>

@endsection