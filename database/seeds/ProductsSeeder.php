<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('products')->insert([
            
			[
				'name' => 'product1',
				'unit_of_measurement' => 'gm',

			],
			[
				'name' => 'product2',
				'unit_of_measurement' => 'ml',
			],
			[
				'name' => 'product3',
				'unit_of_measurement' => 'mm',
			],
			[
				'name' => 'product4',
				'unit_of_measurement' => 'mg',
			],
			[
				'name' => 'product5',
				'unit_of_measurement' => 'cm',
			]
			
		]);
    }
}
