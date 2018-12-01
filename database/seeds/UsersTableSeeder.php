<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	DB::table('users')->insert([ 
	      'name' => $faker->name,
	      'email' => str_random(10).'@gmail.com',
	      'password' => bcrypt('secret'),
    ]);
    }
}
