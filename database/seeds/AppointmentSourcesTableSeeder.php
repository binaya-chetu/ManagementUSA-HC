<?php

use Illuminate\Database\Seeder;

class AppointmentSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointment_sources')->insert([
            [
                'name' => 'Web Leads',
                'description' => 'Create Appointment by the Website contact us form',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tele-marketing Calls',
                'description' => 'Create the appointment from the phone calls for a clinic',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Walkin Patient',
                'description' => 'Create the appointment for the patient whose come directly in the clinic',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
