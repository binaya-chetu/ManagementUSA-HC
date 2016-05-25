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
        // $this->call(UsersTableSeeder::class);
		  DB::table('users')->insert([
            'first_name' => 'Niwedita',
			'last_name' => 'Jaysawal',
            'email' => 'niweditaj@chetu.com',
            'password' => bcrypt('secret'),
		]);
	}
}
