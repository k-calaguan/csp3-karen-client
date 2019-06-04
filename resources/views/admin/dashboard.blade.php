@extends('layouts.app')

@section('content')

<div class="container">
	@if(Session::has("message"))
		<div class="alert col-sm-12 col-lg-4">
			<h3 class="text-{{Session('alert-type')}}">{{Session('message')}} {{Session("user")->name . "!"}}</h3>
		</div>
	@endif
</div>

@endsection