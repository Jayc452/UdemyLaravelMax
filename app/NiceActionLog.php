<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiceActionLog extends Model
{
    //define relationships between this table and other tables
    
	
	//relationship with nice_actions table
    public function nice_action(){
    	
    	//every entry in nice_actions table can have many entries in Nice_actions_logs table
    	//hence here we are using inverse of that define the relationship between NiceActionLog model & NiceAction model
    	return $this->belongsTo('App\NiceAction');
    }
}
