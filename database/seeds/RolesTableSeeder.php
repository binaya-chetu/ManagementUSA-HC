<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('roles')->insert([
           [
                'role_title' => 'Administrators',
                'role_slug' => 'administrator',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
           ],
           [
                'role_title' => 'Admin',
                'role_slug' => 'admin',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
           ],
           [
                'role_title' => 'User',
                'role_slug' => 'user',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
           ],
           [
                'role_title' => 'Authors',
                'role_slug' => 'authors',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
           ],
           [
                'role_title' => 'Doctor',
                'role_slug' => 'doctor',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
           ],
           [
                'role_title' => 'Patient',
                'role_slug' => 'patient',
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
           ],
       ]);
    }
}
