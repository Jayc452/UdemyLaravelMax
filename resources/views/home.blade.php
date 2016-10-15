
<!--  inheriting the master.blade.php file in the layout folder -->
@extends('layout.master')

<!-- the content inside this block will be populated in the corresponding block in master.blade.php -->
@section('content')

	<div class="centered">
	
	
	    <h3> Simple routes - handled without controllers </h3>
		<!--  create links. note the route mentioned in the href tags -->
		<a href="{{ route('greet') }}">Greet</a>
		<a href="{{ route('hug') }}">Hug</a>
		<a href="{{ route('kiss') }}">Kiss</a>
		
		<br>
		<br>
		
		<br>
		<!--  create a form with POST method -->
		<!-- the action is route benice, which is the route that will be executed when the submit button is clicked-->
		<form action="{{ route('benice') }} " method = "post">
		
			<label for="select-action"> I want to</label>
			
			<!--  drop down box that shows different actions -->
			<select id="select-action" name="action">
				<option value="greet">Greet</option>
				<option value="hug">Hug</option>
				<option value="kiss">Kiss</option>
			
			</select>	
			
			<!-- name field  -->
			<input type="text" name="name" />
			
			<!--  submit button  -->
			<button type="submit"> Do a nice action! </button>
			
			<!--  Cross Site Request Forgery (CSRF) protection by laravel  -->
			<!--  get our session token given by laravel and pass it as hidden value to protect against CSRF -->
			<input type = "hidden" value = "{{ Session::token() }}" name="_token">
			
		</form>
		
		<br>
		<br>
		
		
		<h3> These below routes are handled by controllers </h3>
		
		
		<h4> These links are hard coded</h4>
		
		<!--  create links. note the route mentioned in the href tags -->
		<a href="{{ route('niceaction', [ 'action' => 'greet']) }}">Greet</a>
		<a href="{{ route('niceaction', [ 'action' => 'hug'])  }}">Hug</a>
		<a href="{{ route('niceaction', [ 'action' => 'kiss']) }}">Kiss</a>
		
		<br>
		<br>
		
		<h4> These links/actions are got from NiceActions table in DB</h4>
		
		<!--  we get these from getHome method in NiceActionController -->
		@foreach($actions as $action)
		
			<!-- use $action object's name property to show on screen -->
			<a href="{{ route('niceaction',['action' => lcfirst($action->name) ] )  }}"> {{ $action->name }}</a>
		
		@endforeach
		
		<br>
		<br>
		
		<!--  display errors using laravel -->
		<!--  we have an laravel style if loop, inside which we have laravel style forloop -->
		<!--  $errors is a laravel object which contains all the errors when we use laravel's validate method -->
		
		
		@if(count($errors) > 0)
		
		
		
			<div>
				<ul>
				 @foreach($errors->all() as $error)
				      {{ $error }}
				  @endforeach
				</ul>
			</div>
		
	
		@endif
		
		
		
		<!-- 
		@if($errors->has())
			 
			<div>
			  <ul>
			 
				  @foreach ($errors->all() as $error)
				    {{ $error }} 
				  @endforeach
				  
				</ul>
			</div>
			
		@endif
		
		-->
		
		<br>
		<br>
		
		<!--  create a form with POST method -->
		<!-- the action is route benice, which is the route that will be executed when the submit button is clicked-->
		<form action="{{ route('benice') }} " method = "post">
		
			<label for="select-action"> I want to</label>
			
			<!--  drop down box that shows different actions -->
			<select id="select-action" name="action">
				<option value="greet">Greet</option>
				<option value="hug">Hug</option>
				<option value="kiss">Kiss</option>
			
			</select>	
			
			<!-- name field  -->
			<input type="text" name="name" />
			
			<!--  submit button  -->
			<button type="submit"> Do a nice action! </button>
			
			<!--  Cross Site Request Forgery (CSRF) protection by laravel  -->
			<!--  get our session token given by laravel and pass it as hidden value to protect against CSRF -->
			<input type = "hidden" value = "{{ Session::token() }}" name="_token">
			
		</form>
		<br>
		
		<h4> Inserting actions into NiceActions table</h4>
		
			
		
		<h5> Create your actions below</h5>
		
			
		<br>
		<br>
		
		<!--  create a form with POST method -->
		<!-- the action is route benice, which is the route that will be executed when the submit button is clicked-->
		<form action="{{ route('add_action') }} " method = "post">
		
			<label for="actionName"> Name of the action:</label>
			
			<!-- name field  -->
			<input type="text" name="actionName" />
			
			<label for="niceness"> Int value for the action:</label>
			
			<!-- name field  -->
			<input type="text" name="intValueOfAction" />
			
			<!--  submit button  -->
			<button type="submit"> Create a nice action! </button>
			
			<!--  Cross Site Request Forgery (CSRF) protection by laravel  -->
			<!--  get our session token given by laravel and pass it as hidden value to protect against CSRF -->
			<input type = "hidden" value = "{{ Session::token() }}" name="_token">
			
		</form>
		
		<br>
		<br>
				<h6> These are logged actions & their categories</h6>
		
	    <!--  go through all the items in $logged_actions - which contains list of logged actions 
	    FYI $logged_actions is an array of NiceActionLog objects that we got from getHome method in our controller-->
	  	@foreach($logged_actions as $logged_action)
	  	
			<!--  nice_actions table has a one to many relationship with nice_action_logs table AKA NiceActionLog model
			FYI $logged_actions is an array of NiceActionLog object that we got from getHome method in our controller
			this is how we access the name of the niceAction which is logged in the logged_action -->
			<li> {{  $logged_action->nice_action->name	}} 
			
			    
			    <!-- get the category of nice_action from $logged_action which is an object of NiceActionLog 
			    FYI NiceAction & Category model have many to many relationship and this is stored in table categories_nice_actions
			    traverse through all the categories and get the name of each of them using foreach loop
			    -->
			    
				@foreach($logged_action->nice_action->categories as $category)
				     
					{{ $category->name }}
					
				@endforeach
			
			</li>		
					
		@endforeach	
		
	

							
	</div>
	
	
	
	

@endsection('content')