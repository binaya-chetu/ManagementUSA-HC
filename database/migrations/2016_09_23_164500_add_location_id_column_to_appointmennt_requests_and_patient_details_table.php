<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationIdColumnToAppointmenntRequestsAndPatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		 Schema::table('patient_details', function($table)
			{
				$table->integer('location_id');
			});
			Schema::table('appointment_requests', function($table)
			{
				$table->integer('location_id');
			});	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
