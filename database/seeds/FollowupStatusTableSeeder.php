<?php

use Illuminate\Database\Seeder;

class FollowupStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('followup_status')->insert([ 
			[
				'title' => 'Follow-up Later',
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
			[
				'title' => 'Reschedule Appointment',
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
			[
				'title' => 'Cancel Appointment',
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
			[
				'title' => 'Confirmed Appointment',
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
			[
				'title' => 'Never Treat',
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
		]);
    }
}
