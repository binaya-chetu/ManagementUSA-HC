<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration {

    public function up() {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            //$table->datetime('created_at');
            $table->datetime('apptTime'); //appointment_time
            $table->tinyInteger('status')->default(1)->comment('1=>Active, 2=>Reschedule, 3=>Cancel, 4=>Confirm, 5=> Never Treat');
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

    public function down() {
        Schema::drop('appointments');
    }

}
