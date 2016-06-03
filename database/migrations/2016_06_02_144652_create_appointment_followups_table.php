<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('appointment_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appt_id');  
            $table->integer('reason_id'); 
            $table->string('comment');  
            $table->integer('status')->comment('1=>Set, 2=>No Set');;  
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
        //
    }
}
