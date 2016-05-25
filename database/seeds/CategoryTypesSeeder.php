<?php

use Illuminate\Database\Seeder;

class CategoryTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('category_types')->insert([
            
			[
				'name' => 'Bronze'
			],
			[
				'name' => 'Silver'
			],
			[
				'name' => 'Gold'
			]
		]);
    }
}
