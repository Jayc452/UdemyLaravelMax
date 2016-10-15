

<!--  inheriting the master.blade.php file in the layout folder -->
@extends('layout.master')

<!-- the content inside this block will be populated in the corresponding block in master.blade.php -->
@section('content')

	<div class="centered">
	
<!--  {{ $name }} is blade syntax and will populate with the value of $name-->
<!--  if $name is null, return you, else return the name -->
		<h1> I Greet {{ $name === null ? 'you' : $name }}</h1>
						
	</div>

@endsection('content')

