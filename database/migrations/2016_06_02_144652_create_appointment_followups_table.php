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
            $table->integer('appt_id')->comment('If appt_type=1, appt_id = webleads id & if appt_type=2, appt_id = telemarketing call id');  
            $table->integer('reason_id'); 
            $table->tinyInteger('appt_type')->default(0)->comment('1=>Web_leads, 2=> Marketing calls');            
            $table->string('comment');  
            $table->date('followup_date');
            $table->tinyInteger('followup_status')->comment('0=> Not Show , 1=>Show in Listing');  
            $table->tinyInteger('status')->comment('1=>Set, 2=>No Set');            
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
