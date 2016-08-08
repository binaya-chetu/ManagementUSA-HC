<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveExtraColoumsFromAppointmentRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_requests', function($table)
        {
            $table->dropColumn(array('first_name', 'last_name', 'email', 'phone', 'dob', 'location', 'appt_time', 'email_invitation', 'description' )); 
            $table->integer('user_id')->index()->after('id');
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
