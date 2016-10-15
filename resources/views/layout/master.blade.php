<!doctype html>
<html lang="en">

    <!--  this master template will be called by all the other php files and will help us reuse
    this code in other files -->

	<head>
		<meta charset="UTF-8">
		<title>@yield('title')</title>
		<!--  we are referencing file from public folder -->
		<!-- URL is a laravel facade.
		 facades are special operators in laravel which provide short cuts to key methods
		 creates a url to the path -->
		 <!--  if you have issues with css not applying, then replace 'to' with 'secure' in the blade 
		 placeholder for URL below -->
		<link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
	</head>
	
	<body>

		<!--  include header navigation file which is in the includes folder -->
		@include('includes.header')
		
		
	
		<div class="main">
		

		    <!-- yield is a blade template operation which will put in any content that is 
		    present between the @section('content') & @endsection('content') block in the php file
		    that will inherit this master file.  -->
			@yield('content')
		
		</div>
	
	</body>

</html>