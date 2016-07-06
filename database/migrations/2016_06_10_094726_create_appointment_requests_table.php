<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');  
            $table->string('last_name');
            $table->string('email');
            $table->boolean('email_invitation');
            $table->string('phone');  
            $table->date('dob');
            $table->string('location');  
            $table->dateTime('appt_time');  
            $table->string('call_time');  
            $table->string('comment');  
            $table->integer('created_by'); 
            $table->integer('reason_id'); 
            $table->tinyInteger('appt_source')->default(0)->comment('1=>Web_leads, 2=> Marketing calls, 3=> Walikins');            
            $table->string('description');  
            $table->date('followup_date');
            $table->tinyInteger('followup_status')->default(0)->comment('0=> Not Show , 1=>Show in Listing');  
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
