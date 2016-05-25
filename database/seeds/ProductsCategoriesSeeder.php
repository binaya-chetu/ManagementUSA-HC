<?php

use Illuminate\Database\Seeder;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		  DB::table('product_categories')->insert([
            
			[
				'product_id' => 101,
				'category_id' => 1,
				'product_count' => 50,
				'product_price' => 30.25,
				'category_type_id' => 2 
			],
			[
				'product_id' => 102,
				'category_id' => 2,
				'product_count' => 20,
				'product_price' => 100.00,
				'category_type_id' => 3 
			],
			[
				'product_id' => 103,
				'category_id' => 3,
				'product_count' => 30,
				'product_price' => 2000.00,
				'category_type_id' =>4 
			],
			[
				'product_id' => 104,
				'category_id' => 4,
				'product_count' => 10,
				'product_price' => 1500.00,
				'category_type_id' => 1 
			],
			[
				'product_id' => 105,
				'category_id' => 5,
				'product_count' => 60,
				'product_price' => 5000.00,
				'category_type_id' => 5 
			]
			
		]);
    }
}
