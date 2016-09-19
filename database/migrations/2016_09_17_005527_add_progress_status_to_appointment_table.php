<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgressStatusToAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function($table)
        {
            $table->dropColumn(['patient_status']);  
            $table->tinyInteger('progress_status')->comment('1=>Send to Lab, 2=> Waiting for Report, 3=> Ready Lab Report, 4=> New Appointment after lab report');
	});
        Schema::table('appointments', function($table)
        {
            $table->tinyInteger('patient_status')->after('progress_status')->default(0)->comment('1=>Show, 2=>No Show');
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
