<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelativeIdColoumnToAppointmentTable extends Migration
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
<<<<<<< HEAD
            $table->integer('relative_id')->after('id')->comment('Appointment Request Id');
=======
            $table->integer('relative_id')->after('id');
>>>>>>> 82df514e5c5e8c214173ec67818d1a5e5f95eee4
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
