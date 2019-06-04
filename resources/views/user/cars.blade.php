@extends('layouts.app')

@section('content')

<div class="container">
	@if(Session::has("message"))
		<div class="alert col-sm-12 col-lg-4">
			<span class="text-light">{{Session('message')}}</span>
		</div>
	@endif
	@if(Session::has("error"))
		<div class="alert col-sm-12 col-lg-4">
			<span class="text-danger">{{Session('error')}}</span>
		</div>
	@endif
	<div class="card-deck row">
		@foreach(Session('cars') as $car)
		<div class="card col-sm-6 col-lg-3">
			<img src="">
			<div class="card-body">
				 <img src="{{ $car->image }}" class="img-thumbnail">
				 {{ $car->brandMod }}
				 {{ 'Php ' . $car->price }}
				 {{ $car->modYear }}
				 {{ $car->bodyType }}
				 {{ $car->transmission }}
				 {{ $car->engine . ' L'}}
				 {{ $car->fuelType }}
				 {{ $car->seats }}
				 <form method="GET" action="/bookings">
				 	@csrf
				 	<div class="form-group">
				 		<label for="startDate">Start Date</label>
					 	<input id="startDate" type="date" name="startDate" class="form-control" required>
				 	</div>
				 	<div class="form-group">
				 		<label for="endDate">End Date</label>
					 	<input id="endDate" type="date" name="endDate" class="form-control" required>
				 	</div>
					<input type="hidden" name="carId" value="{{$car->_id}}">
					<button type="submit" class="btn btn-outline-danger float-right">Request to book</button>
				 </form>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection