<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNiceActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	
	//this method executes when we write this model to db
	//when this method executes it creates a table in our db corresponding to this method
    public function up()
    {
    	//the table name created will be nice_actions
    	
        Schema::create('nice_actions', function (Blueprint $table) {
        	
        	//id column in the table
            $table->increments('id');
            //timestamp
            $table->timestamps();
            //name column - will contain the name of the person 
            $table->string('name');
            // action column (greet, hug, kiss)
            $table->integer('niceness');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    //this method executes when we rollback
    //when this method executes it will drop the table 
    
    public function down()
    {
        Schema::drop('nice_actions');
    }
}
