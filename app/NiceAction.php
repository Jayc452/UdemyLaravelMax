<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//class defines relationships between NiceAction model/nice_actions table with NiceActionLog model/nice_action_logs tabe
class NiceAction extends Model
{
    
	//relationship between nice_actions table and nice_actions_logs table
	public function logged_actions(){
		
		//every entry in nice_actions table can have many entries in Nice_actions_logs table
		
		return $this->hasMany('App\NiceActionLog');
	}
	
	

	//set the relationship between NiceAction model AKA nice_actions table &
	//categories table AKA Category model
	public function categories(){
	

		//1st param is Model name that this method relates to - categories table related to Category model
		//2nd param is the table name where we will have our categories & niceActions relations mapped.
		return $this->belongsToMany('\App\Category', 'categories_nice_actions');
	
	}
}
