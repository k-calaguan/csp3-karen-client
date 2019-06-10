@extends('layouts.app')

@section('content')

<div class="container mb-3">
	{{-- @dd(Session()) --}}
	{{-- @dd(count(Session('results'))) --}}
	<div class="card" style="border: none">
		<div class="card-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Created</th>
						<th>Customer</th>
						<th>Car Details</th>
						<th>Trans Type</th>
						<th>Total Charge</th>
						<th>Updated</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Session('results') as $result => $data)
					<tr>
						<td>{{ \Carbon\Carbon::parse($data->created_at)->setTimeZone('Asia/Shanghai')->format('d-m-Y g:i:s A') }}</td>
						<td>{{ ucwords($data->customerId->name) }}</td>
						<td>{{ ucwords($data->carId->brandMod) }}</td>
						<td>{{ ucwords($data->transactionType) }}</td>
						<td>Php {{ number_format(($data->totalCharge)/100) }}.00</td>
						<td>{{ \Carbon\Carbon::parse($data->updated_at)->setTimeZone('Asia/Shanghai')->format('d-m-Y g:i:s A') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection