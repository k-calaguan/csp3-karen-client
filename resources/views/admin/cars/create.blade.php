@extends('layouts.app')

@section('content')

<div class="container mb-4">
	@if(Session::has("message"))
		<div class="alert alert-{{Session('type')}} col-sm-12 col-lg-4">
			<span class="text-{{Session('type')}}">{{Session('message')}}</span>
		</div>
	@endif

	@if(Session::has("errors"))
		<div class="alert alert-{{Session('type')}} col-sm-12 col-lg-4">
			<span class="text-{{Session('type')}}">{{Session('message')}}</span>
		</div>
	@endif

	<div class="card col-sm-12 col-lg-6 mt-3">
		<div class="card-body">
			<form method="POST" action="/admin/cars" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="form-group col-sm-12 col-lg-8">
						<label for="brandMod">Brand and Model</label>
						<input id="brandMod" type="text" class="form-control" name="brandMod" value="{{ old('brandMod')}}" required placeholder="Ex. Toyota Altis">
					</div>
					<div class="form-group col-sm-12 col-lg-4">
						<label for="plateNum">Plate No.</label>
						<input id="plateNum" type="text" class="form-control" name="plateNum" value="{{ old('price')}}" value="{{ old('plateNum')}}" required>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 col-lg-7 form-group">
						<label for="price">Price</label>
						<input id="price" type="number" min="1" step="0.01" class="form-control" name="price" value="{{ old('price')}}" required placeholder="Rental fee per day">
					</div>
					
					<div class="col-sm-12 col-lg-5 form-group">
						<label for="modYear">Model year</label>
						<input id="modYear" type="number" min="1900" max="2099" step="1" class="form-control" name="modYear" value="{{ old('modYear')}}" required>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 col-lg-4 form-group">
						<label for="bodyType">Body Type</label>
						<select id="bodyType" class="form-control" name="bodyType" required>
							<option value="{{ old('bodyType') }}">---</option>
							<option value="Crossover">Crossover</option>
							<option value="Jatchback">Hatchback</option>
							<option value="MPV">MPV</option>
							<option value="Sedan">Sedan</option>
							<option value="SUV">SUV</option>
							<option value="Van">Van</option>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 form-group">
						<label for="transmission">Transmission</label>
						<select id="transmission" class="form-control" name="transmission" required>
							<option value="{{ old('transmission')}}">---</option>
							<option value="Automatic">Automatic</option>
							<option value="Manual">Manual</option>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 form-group">
						<label for="fuelType">Fuel type</label>
						<select id="fuelType" class="form-control" name="fuelType" required>
							<option value="{{ old('fuelType')}}">---</option>
							<option value="Diesel">Diesel</option>
							<option value="Gasoline">Gasoline</option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 col-lg-4 form-group">
						<label for="engine">Engine</label>
						<input id="engine" type="number" step="0.1" min="1" class="form-control" name="engine" value="{{ old('engine')}}" required>
					</div>
					<div class="col-sm-12 col-lg-4 form-group">
						<label for="seats">No. of seats</label>
						<input id="seats" type="number" min="1"  class="form-control" name="seats" value="{{ old('seats')}}" required>
					</div>
					<div class="col-sm-12 col-lg-4 form-group">
						<label for="isActive">Status</label>
						<select id="isActive" class="form-control" name="isActive" required>
							<option value="{{ old('isActive')}}">---</option>
							<option value="Active">Active</option>
							<option value="Disable">Disable</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="image">Image</label>
					<div class="custom-file" id="image">
						<input id="imgFile" type="file" class="custom-file-input" name="image" value="{{ old('image')}}" required accept="images/png, image/jpeg, image/jpg">
						<label for="imgFile" class="custom-file-label">Choose file</label>
					</div>
				</div>

				<button type="submit" class="btn btn-outline-danger float-right">Create</button>
			</form>
		</div>
	</div>
</div>

@endsection