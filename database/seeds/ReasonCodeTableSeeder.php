<?php

use Illuminate\Database\Seeder;

class ReasonCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reason_codes')->insert([
            
			[
				'reason' => 'No Insurance',
				'type' => 2,

			],
			[
				'reason' => 'Talk to wife',
				'type' => 2,
			],
			[
				'reason' => 'Information Only',
				'type' => 2,
			],
			[
				'reason' => 'Cant Afford',
				'type' => 2,
			],
			[
				'reason' => 'Think about It',
				'type' => 2,
			],
			[
				'reason' => 'Wrong Number',
				'type' => 2,
			],
			[
				'reason' => 'Scheduling Issue',
				'type' => 2,
			],
			[
				'reason' => 'Advertising Call',
				'type' => 2,
			],
			[
				'reason' => 'Erectile Dysfunction / Premature Ejaculation',
				'type' => 1,
			],
			[
				'reason' => 'HGH Testosterone Therapy',
				'type' => 1,
			],
			[
				'reason' => 'Medical Weight Loss',
				'type' => 1,
			],
			[
				'reason' => 'IV Vitamin Therapy',
				'type' => 1,
			],
			[
				'reason' => 'PRP Priapus  Male Enhancment',
				'type' => 1,
			],
			[
				'reason' => 'Mens Facial Cosmetics and Skincare',
				'type' => 1,
			],
				
		]);
    }
}
