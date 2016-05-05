<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            //$table->datetime('created_at');
            $table->datetime('apptTime'); //appointment_time
            $table->string('status');
            $table->integer('createdBy')->unsigned; //user_id
            $table->integer('lastUpdatedBy')->unsigned;
            $table->integer('patient_id')->unsigned;
			$table->integer('doctor_id')->unsigned;
            $table->integer('marketer')->unsigned; //marketing_id???
            $table->integer('clinic')->unsigned; 
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('appointments');
    }
}
