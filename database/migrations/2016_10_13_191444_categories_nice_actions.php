<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriesNiceActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//we created this entire block because we had only created migrations file for this. hence it was not prefilled
    	//categories_nice_actions is the name of the table we want to create when we run this file
    	Schema::create('categories_nice_actions', function (Blueprint $table) {
    		
	    
	    	$table->increments('id');
	    	$table->timestamps();
	    	
	    	//column for category id	
	    	$table->integer('category_id');
	    	
	    	//column for nice_action id
	    	$table->integer('nice_action_id');
	    	
	    });
    	
    }
    	
    	/**
    	 * Reverse the migrations.
    	 *
    	 * @return void
    	 */
    	public function down()
    	{
    		Schema::drop('categories_nice_actions');
    	}
}
