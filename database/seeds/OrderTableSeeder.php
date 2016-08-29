<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([ 
            [
                'user_id' => 4,
                'agent_id' => 1,
                'package_id' => 1,
                'package_type' => 1,
                'subtotal_amount' => 500.00,
                'discount_amount' => 100.00,
                'total_amount' => 400.00,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 5,
                'agent_id' => 1,
                'package_id' => 1,
                'package_type' => 2,
                'subtotal_amount' => 1000,
                'discount_amount' => 85.00,
                'total_amount' => 915.00,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 6,
                'agent_id' => 1,
                'package_id' => 1,
                'package_type' => 1,
                'subtotal_amount' => 300.00,
                'discount_amount' => 30.00,
                'total_amount' => 270.00,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 4,
                'agent_id' => 1,
                'package_id' => 1,
                'package_type' => 1,
                'subtotal_amount' => 700.00,
                'discount_amount' => 20.00,
                'total_amount' => 680.00,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 5,
                'agent_id' => 1,
                'package_id' => 1,
                'package_type' => 2,
                'subtotal_amount' => 1500.00,
                'discount_amount' => 300.00,
                'total_amount' => 1200.00,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
