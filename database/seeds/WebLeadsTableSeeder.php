<?php

use Illuminate\Database\Seeder;

class WebLeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('web_leads')->insert([
            [
                'first_name' => 'suresh',
                'last_name' => 'kumar',
                'email' => 'sureshc@gmail.com',
                'phone' => '123445',
                'location' =>'2016-06-02 16:00:24',
                'requested_date' => '2016-06-02 16:00:24',
                'call_time' => '11 am - 2 pm',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'binaya',
                'last_name' => 'lenka',
                'email' => 'binayal@gmail.com',
                'phone' => '123445',
                'location' =>'2016-06-02 16:00:24',
                'requested_date' => '2016-06-02 16:00:24',
                'call_time' => '9 am - 11 am',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'first_name' => 'Niwedita',
                'last_name' => 'Jaysawal',
                'email' => 'niweditaj@gmail.com',
                'phone' => '123445',
                'location' =>'2016-06-02 16:00:24',
                'requested_date' => '2016-06-02 16:00:24',
                'call_time' => '11 am - 1pm',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'Amir',
                'last_name' => 'Hnaga',
                'email' => 'amirh@gmail.com',
                'phone' => '123445',
                'location' =>'2016-06-02 16:00:24',
                'requested_date' => '2016-06-02 16:00:24',
                'call_time' => '1 pm - 3 pm',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'Vipul',
                'last_name' => 'kumar',
                'email' => 'vipulk@gmail.com',
                'phone' => '123445',
                'location' =>'2016-06-02 16:00:24',
                'requested_date' => '2016-06-02 16:00:24',
                'call_time' => '3 pm - 5 pm',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
