<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration {

    public function up() {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('apptTime'); //appointment_time
            $table->integer('appt_source');
            $table->integer('request_id');
            $table->integer('disease_id');
            $table->tinyInteger('status')->default(1)->comment('1=>Active, 2=>Reschedule, 3=>Cancel, 4=>Confirm, 5=> Never Treat');
            $table->integer('createdBy')->unsigned; //user_id
            $table->integer('lastUpdatedBy')->unsigned;
            $table->integer('patient_id')->unsigned;
            $table->integer('doctor_id')->unsigned;
            $table->integer('marketer')->unsigned; //marketing_id???
            $table->integer('clinic')->unsigned;
            $table->text('comment');
            $table->tinyInteger('patient_status')->default(0)->comment('1=>Show, 2=>Send to Lab, 3=>Waiting for Report, 4=>Ready Lab Report, 5=>No Show');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('appointments');
    }

}
