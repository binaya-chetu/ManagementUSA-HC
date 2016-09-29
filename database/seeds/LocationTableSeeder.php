<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('locations')->insert([
            [
				'name' =>'Newcastle',
                'city' => 'Newcastle',
                'state' => 'Texas',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
               'name' =>'Lancaster',
                'city' => 'Lancaster',
                'state' => 'South Carolina',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'name' =>'Chester',
                'city' => 'Chester',
                'state' => 'Pennsylvania',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
			
                'name' =>'Andover',
                'city' => 'Andover',
                'state' => 'Ohio',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
				'name' =>'Kent',
                'city' => 'Kent',
                'state' => 'Washington',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
