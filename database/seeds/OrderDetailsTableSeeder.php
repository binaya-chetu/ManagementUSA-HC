<?php

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([ 
            [
                'order_id' => 1,
                'product_id' => 1,
                'product_sku' => 'pro1',
                'quantity' => 1,
                'unit_price' => 300.00,
                'save_amount' => 0.00,
                'total_amount' => 300.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'product_sku' => 'pro2',
                'quantity' => 2,
                'unit_price' => 60.00,
                'save_amount' => 20.00,
                'total_amount' => 100.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 1,
                'product_id' => 3,
                'product_sku' => 'pro3',
                'quantity' => 2,
                'unit_price' => 50.00,
                'save_amount' => 0.00,
                'total_amount' => 100.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 2,
                'product_id' => 1,
                'product_sku' => 'pro1',
                'quantity' => 3,
                'unit_price' => 300.00,
                'save_amount' => 200.00,
                'total_amount' => 700.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 2,
                'product_id' => 2,
                'product_sku' => 'pro2',
                'quantity' => 6,
                'unit_price' => 60.00,
                'save_amount' => 60.00,
                'total_amount' => 300.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 3,
                'product_id' => 1,
                'product_sku' => 'pro1',
                'quantity' => 1,
                'unit_price' => 300.00,
                'save_amount' => 0.00,
                'total_amount' => 300.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 4,
                'product_id' => 4,
                'product_sku' => 'pro4',
                'quantity' => 1,
                'unit_price' => 700.00,
                'save_amount' => 0.00,
                'total_amount' => 700.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 5,
                'product_id' => 1,
                'product_sku' => 'pro1',
                'quantity' => 6,
                'unit_price' => 300.00,
                'save_amount' => 300.00,
                'total_amount' => 1500.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
