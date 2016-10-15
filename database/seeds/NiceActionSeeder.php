<?php

use Illuminate\Database\Seeder;

//import Category class
use App\Category;

//import the NiceAction class
use App\NiceAction;

class NiceActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	
    	//Create records in categories table
    	
    	//make sure you import Category class first
    	
    	//create a entry with category name as Cat 1
    	$category1 = new Category();
    	$category1->name = "Cat 1";
    	$category1->save();
    	

    	//create a entry with category name as Cat 2
    	$category2 = new Category();
    	$category2->name = "Cat 2";
    	$category2->save();
    	
    	
        //Create records in NiceAction table
        
    	//create an object of NiceAction class
    	$nice_action = new NiceAction();
    	
    	//set the name of the action
    	$nice_action->name = "Greet";
    	
    	//set an integer value for the action
    	//so greet action can also be referred to as 3
    	$nice_action->niceness = 3;
    	
    	//save the object
    	$nice_action->save();
    	
    	
    	//$category1 is the Category object we created above. It is a record in categories table.
    	//$nice_actions() method is the method we have in Category table that define that category belongs to make NiceAction model objects
    	//$nice_action is the NiceAction object we created above. It is a record in the nice_actions table
    	//attach is how we associate or link a category with an action
    	$category1->nice_actions()->attach($nice_action);
    	
    	//$category1 is the Category object we created above. It is a record in categories table.
    	//$nice_actions() method is the method we have in Category table that define that category belongs to make NiceAction model objects
    	//$nice_action is the NiceAction object we created above. It is a record in the nice_actions table
    	//attach is how we associate or link a category with an action
    	$category2->nice_actions()->attach($nice_action);
    	
    	
    	
    	//create an object of NiceAction class
    	$nice_action = new NiceAction();
    	 
    	//set the name of the action
    	$nice_action->name = "Hug";
    	 
    	//set an integer value for the action
    	//so greet action can also be referred to as 3
    	$nice_action->niceness = 6;
    	 
    	//save the object
    	$nice_action->save();
    	 
    	$category1->nice_actions()->attach($nice_action);
    	
    	//create an object of NiceAction class
    	$nice_action = new NiceAction();
    	 
    	//set the name of the action
    	$nice_action->name = "Kiss";
    	 
    	//set an integer value for the action
    	//so greet action can also be referred to as 3
    	$nice_action->niceness = 12;
    	 
    	//save the object
    	$nice_action->save();
    	
    	$category2->nice_actions()->attach($nice_action);
    	
    	//create an object of NiceAction class
    	$nice_action = new NiceAction();
    	
    	//set the name of the action
    	$nice_action->name = "Wave";
    	
    	//set an integer value for the action
    	//so greet action can also be referred to as 3
    	$nice_action->niceness = 16;
    	
    	//save the object
    	$nice_action->save();
    	
    	//$category1 is the Category object we created above. It is a record in categories table.
    	//$nice_actions() method is the method we have in Category table that define that category belongs to make NiceAction model objects
    	//$nice_action is the NiceAction object we created above. It is a record in the nice_actions table
    	//attach is how we associate or link a category with an action
    	$category1->nice_actions()->attach($nice_action);
    	 
    	//$category1 is the Category object we created above. It is a record in categories table.
    	//$nice_actions() method is the method we have in Category table that define that category belongs to make NiceAction model objects
    	//$nice_action is the NiceAction object we created above. It is a record in the nice_actions table
    	//attach is how we associate or link a category with an action
    	$category2->nice_actions()->attach($nice_action);
    	 
    }
}
