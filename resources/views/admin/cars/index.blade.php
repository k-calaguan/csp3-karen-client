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

	<a class="btn btn-secondary mb-1" href=".collapseDetails" data-toggle="collapse">
		<span class="text-light">Show Detailed Info</span>
	</a>
	
	<div class="card" style="border: none">
		<div class="card-body table-responsive">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Brand-Model</th>
						<th>Image</th>
						<th class="collapse collapseDetails">Price</th>
						<th class="collapse collapseDetails">Model Year</th>
						<th class="collapse collapseDetails">Body Type</th>
						<th class="collapse collapseDetails">Transmission</th>
						<th class="collapse collapseDetails">Engine</th>
						<th class="collapse collapseDetails">Fuel Type</th>
						<th class="collapse collapseDetails">Seats</th>
						<th>Plate #</th>
						<th>Status</th>
						<th>Total Bookings</th>
						<th>Updated At</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Session::get('cars') as $car)
					<tr>
						<td>{{ $car->brandMod }}</a></td>
						<td>
							<img src="{{ $car->image }}" class="img-thumbnail" style="height: 50px">
						</td>
						<td class="collapse collapseDetails">Php {{ number_format($car->price) }}.00</td>
						<td class="collapse collapseDetails">{{ $car->modYear }}</td>
						<td class="collapse collapseDetails">{{ $car->bodyType }}</td>
						<td class="collapse collapseDetails">{{ $car->transmission }}</td>
						<td class="collapse collapseDetails">{{ $car->engine }} L</td>
						<td class="collapse collapseDetails">{{ $car->fuelType }}</td>
						<td class="collapse collapseDetails">{{ $car->seats }}</td>
						<td>
							{{ $car->plateNum }}
							<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal{{ $car->_id }}"><i class="far fa-edit"></i></button>

							<div id="modal{{ $car->_id }}" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">{{ $car->brandMod }} - {{ $car->plateNum }}</h4 class="modal-title">
										</div>
										<div class="modal-body">
											<div class="container-fluid">

												<form method="post" action="/admin/cars/{{ $car->_id }}" enctype="multipart/form-data">
													@csrf
													@method('PUT')
													<div class="row">
														<div class="form-group col-sm-12 col-lg-8">
															<label for="brandMod">Brand and Model</label>
															<input id="brandMod" type="text" class="form-control" name="brandMod" value="{{ $car->brandMod }}" required placeholder="Ex. Toyota Altis">
														</div>
														<div class="form-group col-sm-12 col-lg-4">
															<label for="plateNum">Plate No.</label>
															<input id="plateNum" type="text" class="form-control" name="plateNum" value="{{ $car->plateNum }}" value="{{ old('plateNum')}}" required>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-12 col-lg-7 form-group">
															<label for="price">Price</label>
															<input id="price" type="number" min="1" step="0.01" class="form-control" name="price" value="{{ $car->price }}" required placeholder="Rental fee per day">
														</div>
														
														<div class="col-sm-12 col-lg-5 form-group">
															<label for="modYear">Model year</label>
															<input id="modYear" type="number" min="1900" max="2099" step="1" class="form-control" name="modYear" value="{{ $car->modYear }}" required>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-12 col-lg-4 form-group">
															<label for="bodyType">Body Type</label>
															<select id="bodyType" class="form-control" name="bodyType" required>
																<option value="{{ $car->bodyType }}">{{ $car->bodyType }}</option>
																<option value="Crossover">Crossover</option>
																<option value="Hatchback">Hatchback</option>
																<option value="MPV">MPV</option>
																<option value="Sedan">Sedan</option>
																<option value="SUV">SUV</option>
																<option value="Van">Van</option>
															</select>
														</div>
														<div class="col-sm-12 col-lg-4 form-group">
															<label for="transmission">Transmission</label>
															<select id="transmission" class="form-control" name="transmission" required>
																@if($car->transmission == "automatic")
																	<option value="Automatic" selected>Automatic</option>
																	<option value="Manual">Manual</option>
																@else
																	<option value="Automatic">Automatic</option>
																	<option value="Manual" selected>Manual</option>
																@endif
															</select>
														</div>
														<div class="col-sm-12 col-lg-4 form-group">
															<label for="fuelType">Fuel type</label>
															<select id="fuelType" class="form-control" name="fuelType" required>
																@if($car->fuelType == "diesel")
																	<option value="Diesel" selected>Diesel</option>
																	<option value="Gasoline">Gasoline</option>
																@else
																	<option value="Diesel">Diesel</option>
																	<option value="Gasoline" selected>Gasoline</option>
																@endif
															</select>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-12 col-lg-4 form-group">
															<label for="engine">Engine</label>
															<input id="engine" type="number" step="0.1" min="1" class="form-control" name="engine" value="{{ $car->engine }}" required>
														</div>
														<div class="col-sm-12 col-lg-4 form-group">
															<label for="seats">No. of seats</label>
															<input id="seats" type="number" min="1"  class="form-control" name="seats" value="{{ $car->seats }}" required>
														</div>
														<div class="col-sm-12 col-lg-4 form-group">
															<label for="isActive">Status</label>
															<select id="isActive" class="form-control" name="isActive" required>
																@if($car->isActive == 1)
																<option value="true" selected>Active</option>
																<option value="false" >Disable</option>
																@else
																<option value="true">Active</option>
																<option value="false" selected>Disable</option>
																@endif
															</select>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-12 col-lg-5 form-group">
															<label for="currImage">Current Image</label>
															<div id="currImage">
																<img src="{{$car->image}}" class="img-thumbnail" style="height: 100px">
															</div>
														</div>
														<div class="col-sm-12 col-lg-7 form-group">
															<label for="image">Upload new image</label>
															<div class="custom-file" id="image">
																<input id="imgFile" type="file" class="custom-file-input" name="image" accept="images/png, image/jpeg, image/jpg">
																<label for="imgFile" class="custom-file-label">Choose file</label>
															</div>
														</div>
													</div>

													<button type="submit" class="btn btn-success float-right">Save</button>
													<button type="button" class="btn btn-secondary float-right mr-1" data-dismiss="modal">Cancel</button>
												</form>

											</div>
										</div>
									</div>
								</div>
							</div>
						</td>
						<td>
							@if($car->isActive == true)
								{{ "Active" }}
							@else
								{{ "Disabled" }}
							@endif
						</td>
						<td>{{ count($car->bookings) }}</td>
						<td>{{ Carbon\Carbon::parse($car->updated_at)->setTimeZone('Asia/Shanghai')->format('d-m-Y g:i:s A') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection