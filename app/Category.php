<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Here we set the relationship between Category model AKA categories table & 
    //NiceAction model AKA nice_actions table
    //Next we also have to go to NiceAction model and set the relationship with categories table there.
    
	public function nice_actions(){
		
		//1st param is Model that this method relates to - nice_actions table related to NiceAction model
		//2nd param is the table name where we will have our categories & niceActions relations mapped.
		return $this->belongsToMany('App\NiceAction', 'categories_nice_actions');
		
	}
	
}
