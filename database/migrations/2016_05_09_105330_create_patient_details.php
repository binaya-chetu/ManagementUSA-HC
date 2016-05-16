<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
             $table->increments('id');
			$table->integer('user_id')->unique();
			$table->date('dob');
			$table->enum('gender', ['Male', 'Female'])->default('Male');;
            $table->string('phone', 15);
            $table->string('address1');
            $table->string('address2'); 
            $table->string('city');
            $table->integer('state');
            $table->string('zipCode',11);
			$table->string('image');
            $table->string('employer');
            $table->string('occupation');
			$table->string('payment_bill');
			$table->boolean('never_treat_status')->default(0);
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
        Schema::drop('patient_details');
    }
}
