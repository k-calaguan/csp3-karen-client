@extends('layouts.app')

@section('content')

<div class="container">
	<div class="card" style="border: none">
		<div class="card-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Created</th>
						<th>Car</th>
						<th>Scheduled Dates</th>
						<th colspan="2">Total Charge</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Session('trans') as $tran)
					<tr>
						<td>{{ \Carbon\Carbon::parse($tran->created_at)->format('m-d-Y') }}</td>
						<td>{{ $tran->carId }} </td>
						<td>
							Start: {{ \Carbon\Carbon::parse($tran->schedDate->startDate)->format('m-d-Y') }}<br>
							End: {{ \Carbon\Carbon::parse($tran->schedDate->endDate)->format('m-d-Y') }}
						</td>
						<td>{{ 'Php ' . number_format($tran->totalCharge, 2) }}</td>
						<td>
							@if($tran->transactionType == "booking")
								<button class="btn btn-secondary btn-sm">Cancel booking</button>
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