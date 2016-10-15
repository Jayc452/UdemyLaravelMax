<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNiceActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nice_action_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            //create a column with name nice_action_id 
            //which will contain the id of the nice action we are logging
            //this id is the primary key in nice_actions table
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
        Schema::drop('nice_action_logs');
    }
}
