

<!--  inheriting the master.blade.php file in the layout folder -->
@extends('layout.master')

<!-- the content inside this block will be populated in the corresponding block in master.blade.php -->
@section('content')

	<div class="centered">
	
	<!-- back button. -->
	<a href="{{ route('home') }}">back</a>
				
		<!--  $action and $name values are got from the route, which got it from the form -->		
		<h1> I {{ $action }} {{ $name }} </h1>
	</div>

@endsection('content')




