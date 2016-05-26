<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('packages')->insert([
            
			[
				'product_id' => 1,
                                'category_id' => 1,
                                'product_count' => 1,
                                'product_price' => 500,
                                'category_type' => 1
                            
			],
			[
				'product_id' => 2,
                                'category_id' => 2,
                                'product_count' => 3,
                                'product_price' => 40,
                                'category_type' => 2
			],
			[
				'product_id' => 3,
                                'category_id' => 2,
                                'product_count' => 4,
                                'product_price' => 700,
                                'category_type' => 3
			],
                        [
				'product_id' => 4,
                                'category_id' => 3,
                                'product_count' => 2,
                                'product_price' => 900,
                                'category_type' => 2
			],
			[
				'product_id' => 5,
                                'category_id' => 4,
                                'product_count' => 3,
                                'product_price' => 1300,
                                'category_type' => 3
			],
		]);
    }
}
