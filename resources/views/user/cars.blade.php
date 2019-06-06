@extends('layouts.app')

@section('content')

<div class="container">
	@if(Session::has("message"))
		<div class="alert col-sm-12 col-lg-5">
			<span class="text-success">{{Session('message')}}</span>
		</div>
	@endif
	@if(Session::has("error"))
		<div class="alert col-sm-12 col-lg-5">
			<span class="text-danger">{{Session('error')}}</span>
		</div>
	@endif

	<div class="card-deck row">
		@foreach(Session('cars') as $car)
		<div class="card col-sm-6 col-lg-4">
			<div class="card-header bg-transparent border-0">
				<div class="container-fluid w-50">
					<img src="{{ $car->image }}" class="img-fluid card-image-top border-0">
				</div>
			</div>

			<div class="card-body" style="line-height: .5;">
				<p>Name: {{ $car->brandMod }}</p>
				<p>Price: {{ 'Php ' . number_format($car->price, 2) }} /day</p>
				
				
				<div class="collapse" id="moreDetails">
					<p>Model Year: {{ $car->modYear }}</p>
					<p>Body Type: {{ $car->bodyType }}</p>
					<p>Transmission: {{ $car->transmission }}</p>
					<p>Engine: {{ $car->engine . ' L'}}</p>
					<p>Fuel type: {{ $car->fuelType }}</p>
					<p>Seats: {{ $car->seats }}</p>
				</div>
			</div>

			<div class="text-center">
				<a class="btn btn-outline-light btn-sm text-center" data-toggle="collapse" data-target="#moreDetails">Show more details</a>					
			</div>

			<div class="card-footer bg-transparent">
				<small class="text-center text-warning">Dates with excess hours difference are subject for prorated charge.</small>
				<p class="text-center">Preferred Dates</p>
				<form method="GET" action="/bookings">
				 	@csrf
				 	<div class="form-group">
					 	<input type="text" name="startDate" class="form-control" placeholder="Start date and time" onfocus="(this.type = 'datetime-local')"  required>
				 	</div>
				 	<div class="form-group">
					 	<input type="text" name="endDate" class="form-control" placeholder="End date and time" onfocus="(this.type = 'datetime-local')"  required>
				 	</div>

					<input type="hidden" name="carId" value="{{$car->_id}}">
					<input type="hidden" name="carPrice" value="{{$car->price}}">
					<button type="submit" class="btn btn-outline-danger float-right">Request to book</button>
				</form>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection