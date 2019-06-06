@extends('layouts.app')

@section('content')

<div class="container">
	<div class="card" style="border: none">
		<div class="card-body table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email Address</th>
						<th>Birth Date</th>
						<th>Gender</th>
						<th>Contact #</th>
						<th>Home Address</th>
						<th>Role</th>
						<th>Registration Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach(Session::get('users') as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ Carbon\Carbon::parse($user->dob)->format('d-m-Y') }}</td>
						@if($user->gender == 'male')
							<td>M</td>
						@elseif($user->gender == 'female')
							<td>F</td>
						@else
							<td>DWTS</td>
						@endif
						<td>0{{ $user->contactNum }}</td>
						<td>{{ $user->homeAddress }}</td>
						@if($user->isAdmin == true)
							<td>Admin</td>
						@else
							<td>User</td>
						@endif
						<td>{{ Carbon\Carbon::parse($user->created_at)->setTimeZone('Asia/Shanghai')->format('d-m-Y g:i:s A') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection