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

	{{-- @dd(Session('trans')) --}}
	<div class="card" style="border: none">
		<div class="card-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Created</th>
						<th>Car</th>
						<th>Scheduled Dates</th>
						<th>Total Charge</th>
						<th>Reference Id</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Session('trans') as $result => $data)
					<tr>
						<td>{{ \Carbon\Carbon::parse($data->created_at)->setTimeZone('Asia/Shanghai')->format('d-m-Y g:i:s A') }}</td>
						<td>{{ ucwords($data->carId->brandMod) }} </td>
						@if(isset($data->schedDate))
							<td>
								Start: {{ \Carbon\Carbon::parse($data->schedDate->startDate)->format('d-m-Y g:i:s A') }}<br>
								End: {{ \Carbon\Carbon::parse($data->schedDate->endDate)->format('d-m-Y g:i:s A') }}
							</td>
						@else
							<td> --- </td>
						@endif
						<td>Php {{number_format(($data->totalCharge)/100)}}.00</td>
						<td>{{ $data->_id }}</td>
						<td>
							@if($data->transactionType == "Booking" || $data->transactionType == "booking")
								@if(\Carbon\Carbon::now()->format('d-m-Y g:i:s A') >= (\Carbon\Carbon::parse($data->schedDate->endDate)->format('d-m-Y g:i:s A')))
									Completed
								@else
									<form method="POST" action="/transactions/refund/{{$data->_id}}">
										@csrf
										<button type="submit" class="btn btn-secondary btn-sm">Cancel booking</button>
									</form>
								@endif
							@elseif($data->transactionType == "Cancellation" || $data->transactionType == "cancellation")
								Refunded
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection