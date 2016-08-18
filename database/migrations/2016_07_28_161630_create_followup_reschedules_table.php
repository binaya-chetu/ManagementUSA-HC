<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowupReschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_reschedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('old_appointment_id')->comment('Appointment before the followup reshedule/later'); 
            $table->integer('new_appointment_id')->comment('Appointment After the followup reshedule/later');;
            $table->integer('followup_id');   
            $table->timestamps();
            $table->softDeletes();
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
