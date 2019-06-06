@extends('layouts.app')

@section('content')

<div class="container">
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
					<tr>
						<td>{{ \Carbon\Carbon::parse(Session('results')->booking->created_at)->setTimeZone('Asia/Shanghai')->format('d-m-Y g:i:s A') }}</td>
						<td>{{ Session('results')->customer->name }}</td>
						<td>{{ Session('results')->car->brandMod }}</td>
						<td>{{ Session('results')->booking->transactionType }}</td>
						<td>{{ Session('results')->booking->totalCharge }}</td>
						<td>{{ \Carbon\Carbon::parse(Session('results')->booking->updated_at)->setTimeZone('Asia/Shanghai')->format('d-m-Y g:i:s A') }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection