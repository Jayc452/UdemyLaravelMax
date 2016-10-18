<?php

//declare the namespace where Controllers class exists
namespace App\Http\Controllers;

//import NiceAction class 
use App\NiceAction;

//import Log facade/class
use Illuminate\Support\Facades\Log;

//import Session class
use Session;

//import DB class, if we are using query builder to interact with database instead of ORM.
use DB;

//class for Request object from post method
use illuminate\Http\Request;

use App\NiceActionLog;

//create a new controller which inherits from Controller class
class NiceActionController extends Controller{
	
	
	//this will return the actions that can be displayed in the home view
	public function getHome(){
		
		Session::flash('message', 'inside Home !');
		
		//retreive all records from the NiceActions table using NiceAction model
		//all is a method that is available in the parent class of NiceAction
		//here we are using ORM to fetch all the records
		$actions = NiceAction::all();
		
		//get all records in nice_actions table. ordered by descending order of niceness
		$actions = NiceAction::orderBy('niceness', 'desc')->get();

		//get all logged actions in the NiceActionLog model
 		$logged_actions = NiceActionLog::all();
 		
 		//enables pagination and returns 5 results per page.
 		$logged_actions = NiceActionLog::paginate(5);
	
 		Log::info('Inside Home:');
 		
		//pass the $actions we got from NiceAction table to home view
		//also pass the logged actions, so we can display them on the home view
		return view('home', ['actions' => $actions, 'logged_actions' => $logged_actions]);
		
	}
	 
	//function that will handle http get method when action links are clicked on the home screen
	//the parameters to this method are passed
	//$name=null is there to handle instances when $name is not passed
	//$action is extracted from the url
	public function getNiceAction($action, $name = null){
		
		//find the niceAction object where name = $action (hug, kiss, greet) that is clicked
		//the first result will be most likely the one we want. else we will need to navigate through all the records
		$nice_action = NiceAction::where('name', $action)->first();
		
		//create an object of NiceActionLogs
		$nice_action_log = new NiceActionLog();
		
		//instead of fetching the id of niceAction and inserting it into nice_action_log table, we will use laravel
		
		
		//insert niceAction into our nice_action_logs table
		
		//we have our NiceAction object that we got above,
		// using that we access logged_actions method which defines relationships between
		//NiceAction & NiceActionLogs models
		//then apply save and pass the argument $nice_action_log which is our log entry
		$nice_action->logged_actions()->save($nice_action_log);
		
		//1st param is the view to be rendered
		//2nd param is the params that can be used in the view
		
		//return view('actions.'.$action, ['name' => $name]);
		
		//check if $name exists else pass "you"
		if($name === null){
				
			$name = "you";
		}
		
		//above we were passing to specific page depending on the action (greet.blade.php, hug.blade.php)
		//instead we will pass to benice view, which can handle any action 
		
		return view('actions.benice', [ 'action' => $action, 'name' => $name]);
	}
	
	
	//function that will handle POST requests
	//the parameters & form values are passed to this function in the Request object
	public function postNiceAction(Request $request){
		
		
		
		
		//this is how we validate form content in laravel
		//1st param is the request object we get from the form
		//2nd param is an array of key, value pairs (associative array), inside which we have form fields.
		//note action here form field used for greet, hug, kiss
		$this->validate($request, [
				'action' => 'required',
				'name' => 'required|alpha'
				
		]);
		
		//the 1st param is the view we want to render
		//2nd param is the list of parameters and their values which we can use to display in the view
		//return the view benice which is in actions folder
		//the params we got from the form are passed the view
		return view('actions.benice', ['action' => $request['action'], 'name' => $request['name']]);
			
		
			
	}//postNiceController
	
	
	//function that will insert actions into table
	//the parameters & form values are passed to this function in the Request object
	public function addNiceAction(Request $request){
	
		Log::info('Inside addNiceAction:');
		Log::info('Inside name is :' .$request['actionName'] );
		Log::info('Inside niceness is :' .$request['intValueOfAction'] );
		
		Log::info('before validate:');
		
		//this is how we validate form content in laravel
		//1st param is the request object we get from the form
		//2nd param is an array of key, value pairs (associative array), inside which we have form fields.
		
		$this->validate($request, [
				
				//if you are using unique, you also need to mention the name of the table 
				//in which we should check & the column name in that table
				'actionName' => 'required|alpha|unique:nice_actions,name',
				'intValueOfAction' => 'required'
	
		]);
	
			
		//create an object of NiceAction
		//you will need to import NiceAction class 
		$nice_action = new NiceAction();
		
		//set the name & niceness properties
		
		//Convert the whole string to lower case and capitalize first character
		$nice_action->name=ucfirst(strtolower($request['actionName']));
		$nice_action->niceness = $request['intValueOfAction'];
		
		
		//save the object
		//this will insert a record into NiceActions table	
		$nice_action->save();
		
// 		if($nice_action->save()){
			
// 			Log::info('data was saved');
			
// 		}
// 		else{
// 			Log::info('data was not saved');
			
// 		}
		
		//if the request was ajax request
		if($request->ajax()){
			
			
			Log::info('request was ajax:');
					
			//return a json response 
			//this will ensure the page is not reloaded with the redirect we have below
			return response()->json();
			
		}
	
		//here we are using redirect
		return redirect()->route('home');
		
			
	
			
	}//addNiceAction
	
	
	
	
} // end of NiceActionController