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
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	DB::table('users')->truncate();
    	DB::table('posts')->truncate();
    	
    	//paramete1:model,Parameter2:number of records to be created.
    	factory(App\User::class,5)->create()->each(function($user)
    		{
    			$user->posts()->save(factory(App\Post::class)->make());	
    		});
    	//If table has no relation.
    	//factory(App\User::class,5)->create()
        
        //When using seeder
        // $this->call(UsersTableSeeder::class);
    }
}
