@extends('layouts.app')

@section('content')

<div class="container">
	{{ "Welcome back " . Session("user")->name . "!" }}
</div>

@endsection