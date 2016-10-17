
<!--  inheriting the master.blade.php file in the layout folder -->
@extends('layout.master')

<!-- the content inside this block will be populated in the corresponding block in master.blade.php -->
@section('content')

<script   src="//code.jquery.com/jquery-1.12.0.min.js"  ></script>

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
			<!--  add a onClick param that will call our Javascript send function, so that we can use ajax to process the form -->
			<button type="submit" > Do a nice action! </button>
			
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
		
		<h4> These links/actions are got from NiceActions table in DB & work using GET method</h4>
		
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
		
		
		<h4> The below form uses POST method </h4>
		
		@if(count($errors) > 0)
		
			<P> WE HAVE ERRORS </P>
		
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
		<form action="{{ route('benicePost') }} " method = "post">
		
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
			
			
		
		<h4> Create your actions below</h4>
		
			
		<br>
		<br>
		
		<!--  create a form with POST method -->
		<!-- the action is route benice, which is the route that will be executed when the submit button is clicked-->
		<form action="{{ route('add_action') }}" method = "post">
		
			<label for="actionName"> Name of the action:</label>
			
			<!-- name field  -->
			<input type="text" name="actionName" id="actionName"/>
			
			<label for="niceness"> Int value for the action:</label>
			
			<!-- name field  -->
			<input type="text" name="intValueOfAction" id="intValueOfAction" />
			
			<!--  submit button  -->
			<button type="submit"  onclick="send(event)"> Create a nice action! </button>
			
			<!--  Cross Site Request Forgery (CSRF) protection by laravel  -->
			<!--  get our session token given by laravel and pass it as hidden value to protect against CSRF -->
			<input type = "hidden" value = "{{ Session::token() }}" name="_token">
			
		</form>
		
		<br>
		<br>
		 <button onclick="alert('Hi')">Click Me - Button 1!</button>
	
		<br>
		<br>
			 <button id="testButton">Click Me - Button 2!</button>
			 
		<br>
		<br>
		<br>
		<br>

		
			 
		<br>
		<br>
			 <button onclick="sendTest(Event)">Click Me - Button 3!</button>
			 
		<br>
		<br>
				<h4> These are logged actions & their categories</h4>
				
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
		
		<br><br>
			
			<!--  shows pagination links on beside the other -->
			
		@if($logged_actions->lastPage() > 1)
		
			@for($i = 1; $i  <= $logged_actions->lastPage(); $i++)
			
			    <!--  url method available because we used paginate method to get the logged_actions -->
				<a href="{{ $logged_actions->url($i) }}"> {{ $i }}</a>
			
			@endfor
		
		@endif
							
	</div>
	
	<script type="text/javascript">

	
// 		 alert("Page loaded!");

// 		 //check if jquery exists
// 		if(typeof jQuery !== "undefined"){  // this checks if jQuery variable exists or is undefined and else command too works here
// 			alert("jQuery is installed");		
// 		}
// 		else {
// 			alert("jQuery is not installed");
// 		}

// 		//access the button with its id
// 		$("#testButton").click(function()  { 

// 			alert("Button 2 is clicked");

// 		});

			
		function sendTest(event){

			alert("Button 3 clicked");

		}


		// send function
		//this function is called when the submit button is clicked. see the form above.
		function send(event){

			//dont do the default action which would reload the page.
			event.preventDefault(); 	

			name =  $("#actionName").val();
			niceness =  $('#intValueOfAction').val();
			token = "{{ Session::token() }}";
			
			alert("so you want to create an action for " + name + " " + niceness + " " + token);

// 			Log::info('create ajax request');
			//create ajax call
			$.ajax({

				
				
				//This is a Http POST request 
				type:"POST",
				//the url for the handling the POST request
				//note that we are using blade template to 
				url:"{{ route('add_action') }}",
				//get the form values from nice & niceness fields in the form using their id (NOT name)
				//also pass the session token which is very important
				data: {actionName: $("#actionName").val(), intValueOfAction: $('#intValueOfAction').val(), _token: "{{ Session::token() }}" }
				

			});
				
		}
	
	
	</script>
	
	

@endsection('content')