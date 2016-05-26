<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('categories')->insert([
            
			[
				'cat_name' => 'Himeros Male Enhancement Packages',
				'duration_months' => 6,

			],
			[
				'cat_name' => 'Trimix Therapy Package',
				'duration_months' => 3,
			],
			[
				'cat_name' => 'Vitamin Therapy Packeage',
				'duration_months' => 5,
			],
			[
				'cat_name' => 'Weight Loss Individual Pricing',
				'duration_months' => 8,
			],
			[
				'cat_name' => 'Testosterone Therapy Indivisual Pricing',
				'duration_months' => 3,
			],
			[
				'cat_name' => '21 Days Challenge Diet',
				'duration_months' => 1,
			],
			[
				'cat_name' => 'HCG Diet',
				'duration_months' => 3,
			],
			[
				'cat_name' => 'Appetite Supperssant Diet',
				'duration_months' => 8,
			],
			[
				'cat_name' => 'Low Carb Protien Diet',
				'duration_months' => 3,
			],
			[
				'cat_name' => 'Testosterone Total Health Therapy',
				'duration_months' => 12,
			],
			[
				'cat_name' => 'HGH Low Level anti Aging Therapy',
				'duration_months' => 3,
			],
			
			[
				'cat_name' => 'Sublingual Troche Therapy Packages',
				'duration_months' => 3,
			]
			
			
		]);
    }
}
