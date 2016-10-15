<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	//call this class to seed NiceAction table
        $this->call(NiceActionSeeder::class);
        
//     	$this->call('NiceActionSeeder');
    	
    	$this->command->info("Nice Actions table seeded");
    	
    }
}
