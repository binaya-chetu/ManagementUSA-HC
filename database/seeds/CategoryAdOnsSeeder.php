<?php

use Illuminate\Database\Seeder;

class CategoryAdOnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_add_ons')->insert([
            [
                'category_id' => 1,
                'add_on_name' => 'add_on1',
                'cost' => 5000.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => 2,
                'add_on_name' => 'add_on2',
                'cost' => 8000.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => 3,
                'add_on_name' => 'add_on3',
                'cost' => 6000.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => 4,
                'add_on_name' => 'add_on4',
                'cost' => 9000.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => 5,
                'add_on_name' => 'add_on5',
                'cost' => 10000.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}