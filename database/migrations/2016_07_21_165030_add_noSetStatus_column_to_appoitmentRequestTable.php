<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoSetStatusColumnToAppoitmentRequestTable extends Migration
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
            $table->tinyInteger('noSetStatus')->after('status')->comment('0 => Next Appointment, 1 => End Appointment');
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
