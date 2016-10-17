<?php



use App\Http\Controllers\NiceActionController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 
//return the home view for the root page
//commenting out this code to return home view, cause we are using NiceActionController 
//to handle this. See below


Route::get('/', function () {
    return view('home');
})->name('home');

*/

/*
 * all the routes inside this block will get 'do' prefixed to their url
 * for example..
 * http://laraveldemomax.dev/do/benice
 * http://laraveldemomax.dev/do/greet
 *
 */

Route::group(['prefix' => 'do'], function(){
	
	//-----------------------------------
	//     ROUTE WITH NO PARAMETERS
	//-----------------------------------
	
	//you can invoke or call this route in the code by using its name
	// this is done in home.blade.php where we have created the links (greet,hug & kiss)
	//the url for this route is /hug
	Route::get('/hug', function () {
	
		//returns the view hug.blade.php in the actions folder
		return view('actions.hug');
	
		//name of the route
	})->name('hug');
	
	
	
	//------------------------------
	//    ROUTE WITH PARAMETERS
	//------------------------------
	
	//the name of this route is greet
	//you can invoke or call this route in the code by using its name or going to the url /greet
	//this is done in home.blade.php where we have created the links (greet,hug & kiss)
	//the url for this route is /greet or /greet/<someName>
	//{name?} is blade synatx indicating that there is parameter passed there.
	//the ? indicates that the parameter is optional
	//name parameter is got from the formin home.blade.php
	// in the function $name = null, is set in the event there is no name parameter passed in url
    //here the name has to be directly there in the url itself. 
    //to test go to url http://laraveldemomax.dev/greet/somenameheere & http://laraveldemomax.dev/greet
	Route::get('/greet/{name?}', function ($name = null) {
	
		//the 1st param is the view we want to render
		//2nd param is the list of parameters and their values which we can use to display in the view
		//return greet.blade.php view which is in actions folder
		//pass a variable 'name' whose value we got from url
		return view('actions.greet', ['name' => $name]);
	})->name('greet');
	
	
	
	Route::get('/kiss', function () {
		return view('actions.kiss');
	})->name('kiss');
	
	
	
	//this route will handle POST request
	//inside the function param, the $request object will hold the values of the form
	Route::post('/benice', function(Illuminate\Http\Request $request) {
	
	
		if(isset($request['action']) && ($request['name'])){
	
			if(strlen($request['name']) > 0){
	
				//the 1st param is the view we want to render 
				//2nd param is the list of parameters and their values which we can use to display in the view
				//return the view benice which is in actions folder
				//the params we got from the form are passed the view
				return view('actions.benice', ['action' => $request['action'], 'name' => $request['name']]);
			}
	
	
			//if name is not present in the form, take the user back
			return redirect()->back();
	
		}
	
	
		//if params are not set in the form, dont do anything
		return redirect()->back();
	
		//name of route is benice
	})->name('benice');
	
	
}); //end of 'do' route prefix block





/*  ------------------------------
 *    ROUTE WITH CONTROLLERS
 *   ----------------------------
 */


//Using NiceActionController to return the home view
Route::get('/', [
		
		'uses' =>'NiceActionController@getHome',
		'as' => 'home'
]);

/*
 * GET method.
 * url has an action & name parameter. Name is optional.
 * the processin for this route is done in the controller
 * since this is a get request, the parameters are passed in the url itself
 * 
 */ 

Route::get('/{action}/{name?}', [

		//controller & method in it that is used to process requests to this route
		'uses' => 'NiceActionController@getNiceAction',

		//name of this route
		//this is the name that will be used in the views
		'as' => 'niceaction'

]);


/*
 * POST method.
 * parameters are passed through post method
 * the processin for this route is done in the controller
 *
 */

Route::post('/benicePost', [
	
		//controller & method in it that is used to process requests to this route
		'uses' => 'NiceActionController@postNiceAction',
			
		//name of this route
		//this is the name that will be used in the views
		'as'=> 'benicePost'
		
]);


/*
 * Insert an action into db using addNiceAction method in NiceController
 * Note this form uses http post method to send the form content  
 * 
*/


Route::post('/', [

		//controller & method in it that is used to process requests to this route
		'uses' => 'NiceActionController@addNiceAction',
			
		//name of this route
		//this is the name that will be used in the views
		'as'=> 'add_action'

]);

Route::get('log/log/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');






